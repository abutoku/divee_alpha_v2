<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Storege
use Illuminate\Support\Facades\Storage;
//Validator
use Illuminate\Support\Facades\Validator;
//認証
use Illuminate\Support\Facades\Auth;

//model
use App\Models\User;
use App\Models\Profile;
use App\Models\Buddy;
use App\Models\Shop;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //メンバー一覧を表示する関数
    public function index()
    {
        //$profiles = Profile::all(); 全て取得
        $login_user = User::find(Auth::user()->id);

        $shop = Shop::find($login_user->profile->shop_id);



        // カードランクごとにデータ取得
        $pro = Profile::where('shop_id',$login_user->profile->shop_id)
                        ->where('card_rank', 'Pro')->get();
        $dm = Profile::where('shop_id',$login_user->profile->shop_id)
                        ->where('card_rank', 'DM')->get();
        $msd = Profile::where('shop_id',$login_user->profile->shop_id)
                        ->where('card_rank', 'MSD')->get();
        $aow = Profile::where('shop_id',$login_user->profile->shop_id)
                        ->where('card_rank', 'AOW')->get();
        $ow = Profile::where('shop_id',$login_user->profile->shop_id)
                        ->where('card_rank','OW')->get();

        return view ('profile.index', [
            'pro' => $pro,
            'dm' => $dm,
            'msd' => $msd,
            'aow' => $aow,
            'ow' => $ow,
            'shop' => $shop,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //プロフィール登録画面を表示する
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //プロフィール登録
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'card_rank' => 'required',
            'dive_count' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('profile.create')
                ->withInput()
                ->withErrors($validator);
        }

        //DBに保存 profile_imageは仮画像を設定
        $result = Profile::create([
            "card_rank" => $request->card_rank,
            "dive_count" => $request->dive_count,
            "profile_image" => 'uploads/null.png',
            "cover_image" => 'uploads/cover.jpg',
            "user_id" => Auth::user()->id
        ]);

        // profile.index にリクエスト送信（一覧ページに移動）
        return redirect()->route('shop.create');
    }

    /**
     * Display the specified resource.
     *
    * @param  int  $id
    * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //profle_tableからユーザーidが一致するレコードを取得
        $profile = Profile::where('user_id',$id)->first();
        //profile.indexに$profileと$userを渡す
        return view('profile.show', ['profile' => $profile]);
    }

    public function list($id)
    {
        //profle_tableからユーザーidが一致するレコードを取得
        $profile = Profile::where('user_id',$id)->first();
        $buddies = Buddy::where('buddy_id',$id)->groupBy('user_id')->get('user_id');

        return view('profile.list', [
            'profile' => $profile,
            'buddies' => $buddies,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //プロフィール写真変更ページを表示する
    public function edit($id)
    {
        $profile = Profile::find($id);

        //ログインユーザー以外の情報は表示しない
        if(Auth::user()->id != $profile->user_id) {
        return abort('404');
        }
        return view('profile.edit', ['profile' => $profile]);
    }

    //カバー写真変更ページを表示する
    public function cover($id)
    {
        $profile = Profile::find($id);

        //ログインユーザー以外の情報は表示しない
        if (Auth::user()->id != $profile->user_id) {
            return abort('404');
        }
        return view('profile.cover', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //プロフィール写真の変更の関数
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|file|image'
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('profile.show', Auth::user()->id)
                ->withInput()
                ->withErrors($validator);
        }
        //リクエストファイルの画像を取得
        $upload_image = $request->file('profile_image');

        //画像をpublic直下のuploadsに保存し$pathにパスを取得
        $path = $upload_image->store('uploads', "public");

        if ($path) {
        //DBを書き換え
        $oldpath = Profile::find($id)->profile_image;
        if($oldpath !== 'uploads/null.png'){
                Storage::disk('public')->delete($oldpath);
        }
        $result = Profile::find($id)->update(['profile_image' => $path]);
        }
        //profile.showへ移動（現在ログインしているユーザー情報）
        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function coverchange(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'cover_image' => 'required|file|image'
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('profile.cover', Auth::user()->id)
                ->withInput()
                ->withErrors($validator);
        }

        //リクエストファイルの画像を取得
        $upload_image = $request->file('cover_image');

        //画像をpublic直下のuploadsに保存し$pathにパスを取得
        $path = $upload_image->store('uploads', "public");

        if ($path) {
        //DBを書き換え
        $oldpath = Profile::find($id)->cover_image;
        if($oldpath !== 'uploads/cover.jpg'){
                Storage::disk('public')->delete($oldpath);
        }

        $result = Profile::find($id)->update(['cover_image' => $path]);
        }

        //profile.showへ移動（現在ログインしているユーザー情報）
        return redirect()->route('profile.show', Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    public function menu()
    {
        return view('profile.menu');
    }

    public function ranking()
    {
        //関数実行、取得した情報を$profilesに代入
        $profiles = Profile::getAllOrderByDiveCount();

        //profile.rankingに取得した$profilesを渡す
        return view('profile.ranking', [
            'profiles' => $profiles
        ]);
    }

}
