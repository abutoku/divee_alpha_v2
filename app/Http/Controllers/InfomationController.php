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
