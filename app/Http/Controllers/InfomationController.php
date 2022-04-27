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
use App\Models\Infomation;

class InfomationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('infomation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infomation.create');
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
    public function show($id)
    {
        //profle_tableからユーザーidが一致するレコードを取得
        $infomation = Infomation::where('user_id',$id)->first();
        //profile.indexに$profileと$userを渡す
        return view('infomation.show', ['infomation' => $infomation]);
    }

    public function logo($id)
    {
        $infomation = Infomation::where('user_id',$id)->first();

        //ログインユーザー以外の情報は表示しない
        if(Auth::user()->id != $infomation->user_id) {
        return abort('404');
        }

        return view('infomation.logo', ['infomation' => $infomation]);
    }

    public function cover($id)
    {
        $infomation = Infomation::where('user_id',$id)->first();

        //ログインユーザー以外の情報は表示しない
        if (Auth::user()->id != $infomation->user_id) {
            return abort('404');
        }
        return view('infomation.cover', ['infomation' => $infomation]);
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

    //ロゴ画像の変更の関数
    public function updatelogo(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'logo' => 'required|file|image'
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('infomation.logo', Auth::user()->id)
                ->withInput()
                ->withErrors($validator);
        }
        //リクエストファイルの画像を取得
        $upload_image = $request->file('logo');

        //画像をpublic直下のuploadsに保存し$pathにパスを取得
        $path = $upload_image->store('uploads', "public");

        if ($path) {
        //DBを書き換え
        $oldpath = Infomation::find($id)->logo_image;
        if($oldpath !== 'uploads/null.png'){
                Storage::disk('public')->delete($oldpath);
        }
        $result = Infomation::find($id)->update(['logo_image' => $path]);
        }
        //profile.showへ移動（現在ログインしているユーザー情報）
        return redirect()->route('infomation.logo',Auth::user()->id);

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
        //
    }
}
