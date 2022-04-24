<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Model
use App\Models\Post;
//認証
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    //いいね登録の関数
    public function store(Post $post)
    {
        //中間テーブルへの追加
        $post->users()->attach(Auth::id());
        //今まで表示していたページに戻る
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    //いいね解除の関数
    public function destroy(Post $post)
    {
        //中間テーブルからの削除
        $post->users()->detach(Auth::id());
        //今まで表示していたページに戻る
        return back();
    }
}
