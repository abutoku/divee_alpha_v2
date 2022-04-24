<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Storege
use Illuminate\Support\Facades\Storage;
//Validator
use Illuminate\Support\Facades\Validator;

//Model
use App\Models\Shop;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return view('admin.index',[
            'shops' => $shops,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'shop_name' => 'required',
            'logo_image' => 'required',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('admin.create')
                ->withInput()
                ->withErrors($validator);
        }


        if($request->cover_image !== null) {

            $upload_logo = $request->file('logo_image');
            $logo_path = $upload_logo->store('uploads', "public");

            $upload_cover = $request->file('cover_image');
            $cover_path = $upload_cover->store('uploads', "public");

            $data = $request->merge([
                'logo' => $logo_path,
                'cover' => $cover_path ])->all();

            $result = Shop::create($data);

        } else {

            // カバー画像がない場合
            $upload_logo = $request->file('logo_image');
            $logo_path = $upload_logo->store('uploads', "public");

            $data = $request->merge([
                'logo' => $logo_path,
            ])->all();

            $result = Shop::create($data);

        }

        return redirect()->route('dashboard');

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
    public function destroy($id)
    {

        $shop = Shop::find($id);


        //ロゴ画像をストレージから削除
        Storage::disk('public')->delete($shop->logo);

        //カバー画像をストレージから削除
        if($shop->cover !== 'uploads/cover.jpg'){
            Storage::disk('public')->delete($shop->cover);
        }

        $result = Shop::find($id)->delete();

        return redirect()->route('admin.index');
    }
}
