<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Validator
use Illuminate\Support\Facades\Validator;
//model
use App\Models\Setdata;

class SetdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setdatas = Setdata::all();
        return view('setdata.index',[
            'setdatas' => $setdatas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setdata.create');

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
            'site_name' => 'required',
            'temp' => 'required',
            'pc' => 'required',
            'hc' => 'required',
            'jan' => 'required',
            'feb' => 'required',
            'mar' => 'required',
            'apr' => 'required',
            'may' => 'required',
            'jun' => 'required',
            'jul' => 'required',
            'aug' => 'required',
            'sep' => 'required',
            'oct' => 'required',
            'nov' => 'required',
            'dec' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('setdata.create')
                ->withInput()
                ->withErrors($validator);
        }


        $result = Setdata::create($request->all());
        return redirect()->route('setdata.index');
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
        $setdata = Setdata::find($id);
        return view('setdata.edit',[
            'setdata' => $setdata
        ]);
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
        // バリデーション
        $validator = Validator::make($request->all(), [
            'site_name' => 'required',
            'temp' => 'required',
            'pc' => 'required',
            'hc' => 'required',
            'jan' => 'required',
            'feb' => 'required',
            'mar' => 'required',
            'apr' => 'required',
            'may' => 'required',
            'jun' => 'required',
            'jul' => 'required',
            'aug' => 'required',
            'sep' => 'required',
            'oct' => 'required',
            'nov' => 'required',
            'dec' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('setdata.create')
                ->withInput()
                ->withErrors($validator);
        }

        $result = Setdata::find($id)->update($request->all());
        return redirect()->route('setdata.index');

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
