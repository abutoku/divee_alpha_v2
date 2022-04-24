<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//Storege
use Illuminate\Support\Facades\Storage;

//Validator
use Illuminate\Support\Facades\Validator;
//認証
use Illuminate\Support\Facades\Auth;

//Model
use App\Models\User;
use App\Models\Log;
use App\Models\Book;
use App\Models\Site;
use App\Models\Divemap;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //----3/24 livewire 移行----------------------------------------------

        // Userモデルに定義したmybooks関数を実行し、結果を$booksに受け取る
        // $books = User::find(Auth::user()->id)->mybooks;
        // return view('book.index', [
        //     'books' => $books
        // ]);
        return view('book.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //図鑑詳細画面へ
    public function show($id)
    {
        $book = Book::find($id);
        $sites = Site::all();

        //ログインユーザー以外の情報は表示しない
        if (Auth::user()->id != $book->user_id) {
            return abort('404');
        }

        //logからbook_idが一致しているものを取得
        $logs = Log::where('book_id',$id)->get();

        return view('book.show', [
            'book' => $book,
            'logs' => $logs,
            'sites' => $sites,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //図鑑写真変更画面へ
    public function select($id)
    {
        //book_tableからidが一致するレコードを取得
        $book = Book::find($id);

        //ログインユーザー以外の情報は表示しない
        if (Auth::user()->id != $book->user_id) {
            return abort('404');
        }
        //logからbook_idが一致しているものを全件取得
        $logs = Log::where('book_id',$id)->get();

        return view('book.select', [
            'book' => $book,
            'logs' => $logs,
        ]);
    }

    //図鑑写真更新のメソッド
    public function change(Request $request,$id)
    {

        $pic = Log::find($request->log_id)->image;
        $book = Book::find($id)->update(['picture' => $pic]);

        return redirect()->route('book.show', $id);
    }


    //MEMO入力画面へ
    public function memo($id)
    {
        $book = Book::find($id);

        //ログインユーザー以外の情報は表示しない
        if(Auth::user()->id != $book->user_id) {
        return abort('404');
      }

        return view('book.memo', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //MEMO更新のメソッド
    public function update(Request $request, $id)
    {
        $result = Book::find($id)->update(['info' => $request->info]);
        return redirect()->route('book.show', $id);
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

    public function search(Request $request)
    {
        $sites = Site::all();

        $logs = Log::where('user_id',Auth::user()->id)
                    ->where('site_id',$request->site_id)->get();

        $book = Book::find($request->book_id);

        $val = Site::find($request->site_id);

        return view('book.show', [
            'logs' => $logs,
            'sites' => $sites,
            'book' => $book,
            'val' => $val
        ]);
    }

}
