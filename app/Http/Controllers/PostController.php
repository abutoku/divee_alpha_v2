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
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Picture;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //ログの一覧表示の関数
    public function index()
    {
        //関数実行、取得した情報を$postに代入
        $posts = Post::getAllOrderByDate();
        //post.indexに取得した$postを渡す
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //ログ入力画面を表示
    public function create()
    {
        //post.create（登録ページ）を表示
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //ログ登録の関数
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('post.create')
                ->withInput()
                ->withErrors($validator);
        }


        // 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        //Auth::user()->idで現在ログインしているユーザの ID を取得することができる
        //Auth::user()には他にもデータが入っている
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        // 戻り値は挿入されたレコードの情報
        // create()は最初から用意されている関数
        $result = Post::create($data);



        return redirect()->route('picture.edit',$result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ログの詳細表示の関数
    public function show($id)
    {
        //受け取った ID の値でテーブルからデータを取り出して$logに代入
        $post = Post::find($id);
        //$postをpost.showに渡す
        return view('post.show', ['post' => $post]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ログ編集画面を表示
    public function edit($id)
    {
        //post_tableからidが一致しているものを$idに代入
        $post = Post::find($id);

        //ログインユーザー以外の情報は表示しない
        if(Auth::user()->id != $post->user_id) {
        return abort('404');
        }
        //post.editに取得した$postを渡す
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ログ更新の関数
    public function update(Request $request, $id)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('post.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
        //データ更新処理
        // updateは更新する情報がなくても更新が走る（updated_atが更新される）
        $result = Post::find($id)->update($request->all());
        // fill()save()は更新する情報がない場合は更新が走らない（updated_atが更新されない）
        
        // $redult = Post::find($id)->fill($request->all())->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ログ削除の関数
    public function destroy($id)
    {
        //画像URL取得
        $pictures = Picture::where('post_id',$id)->get();

        //画像削除
        foreach ($pictures as $picture){
                Storage::disk('public')->delete($picture->picture);
        }

        //post_tableからidが一致しているものを削除
        $result = Post::find($id)->delete();
        //post.indexへ戻る
        return redirect()->route('post.index');
    }

    //自分の投稿を表示する関数
    public function mydata()
    {
        // Userモデルに定義したmyposts関数を実行する．
        //結果を$postsに受け取る
        $posts = User::find(Auth::user()->id)->myposts;
        //$postsをpost.indexに渡す
        return view('post.index', [
            'posts' => $posts
        ]);
    }
}
