<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Storege
use Illuminate\Support\Facades\Storage;
//Validator
use Illuminate\Support\Facades\Validator;
//認証
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use GuzzleHttp\Client;

//Model
use App\Models\User;
use App\Models\Log;
use App\Models\Book;
use App\Models\Site;
use App\Models\Location;
use App\Models\Divemap;


class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Userモデルに定義したmylogs関数を実行
        $logs = User::find(Auth::user()->id)->mylogs;

        $sites = Site::all();

        // 工事中
        // $dates = Log::where('user_id',Auth::user()->id)->groupBy('date')->get('date');


        return view('log.index', [
            'logs' => $logs,
            'sites' => $sites,
            // 'dates' => $dates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();
        $divemaps = Divemap::all();

        return view('log.create', [
            'sites' => $sites,
            'divemaps' => $divemaps,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // バリデーション
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'name' => 'required',
            'site_id' => 'required',
            'temp' => 'required',
            'depth' => 'required',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('log.create')
                ->withInput()
                ->withErrors($validator);
        }

        //booksテーブルから、生物名とユーザーIDが一致しているものを取得(なければ作成)
        $book = Book::firstOrCreate([
        'fish_name' => $request->name,
        'user_id' => Auth::user()->id ]);


        //画像が有りの場合
        if($request->image_data !== null) {

            $upload_image = $request->file('image_data');

            //画像をpublic直下のuploadsに保存し$pathにパスを取得
            $path = $upload_image->store('uploads', "public");
            $data = $request->merge([
                'user_id' => Auth::user()->id ,
                'image' => $path,
                'book_id' => $book->id ])->all();

            //bookに画像が登録されていない場合は登録
            if ($book->picture == null){
                    $book->picture = $path;
                    $book->save();
            }

        } else { //画像無し

            // フォームから送信されてきたデータとユーザIDをマージし
            $data = $request->merge([
                'user_id' => Auth::user()->id,
                'book_id' => $book->id ])->all();
        }

        //$dateをDBに保存
        $result = Log::create($data);

        //locationを作成
        $location = Location::create([
        'log_id' => $result->id,
        'name' => $result->book->fish_name,
        'latitude' => $result->site->latitude,
        'longitude' => $result->site->longitude
        ]);


        //bookに目、科が登録されていない場合はAPIへリクエスト
        if ($book->order == null) {
            $name = $book->fish_name;

            //APIリクエスト
            $client = new Client();
            $response = $client->get("https://odd-tsushima-1917.lolipop.io/api/getfishcategory?name={$name}");

            //情報を受け取り
            $res = $response->getBody();
            $res = json_decode($res, true);

            //DBを更新
            $category = Book::find($book->id)
                        ->update([
                            'order' => $res['order'],
                            'family' => $res['family'],
                        ]);

        }

        // ルーティング「log.index」にリクエスト送信（一覧ページに移動）
        session()->flash('status', '登録が完了しました');
        return redirect()->route('log.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $log = Log::find($id);

        if (Auth::user()->id != $log->user_id) {
            return abort('404');
        }


        if($log->divemap_id !== null) {

        $map = Divemap::find($log->divemap_id);

        return view('log.show', [
            'log' => $log,
            'map' => $map,
        ]);

        }else{

            return view('log.show', [
                'log' => $log,
                'map' => [],
            ]);

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ログの画像を取得
        $path = Log::find($id)->image;
        //画像のパスがある場合は、ストレージから削除
        if($path !== 'null'){
                Storage::disk('public')->delete($path);
        }

        //log_tableからidが一致しているものを削除
        $result = Log::find($id)->delete();
        //log.indexへ戻る
        return redirect()->route('log.index');
    }

    public function search (Request $request) {

        $sites = Site::all();
        $logs = Log::where('user_id',Auth::user()->id)
                    ->where('site_id',$request->site_id)->get();

        return view('log.index', [
            'logs' => $logs,
            'sites' => $sites,
        ]);
    }
}
