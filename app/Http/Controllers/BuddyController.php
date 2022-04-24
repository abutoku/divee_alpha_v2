<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Validator
use Illuminate\Support\Facades\Validator;
//認証
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\User;
use App\Models\Buddy;
use App\Models\Profile;

class BuddyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Buddy::where('buddy_id',Auth::user()->id)->update(['is_checked' => true ]);

        $buddies = Buddy::where('buddy_id',Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->get();

        return view('buddy.index',[
            'buddies' => $buddies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $login_user = User::find(Auth::user()->id);
        $profiles = Profile::where('shop_id',$login_user->profile->shop_id)->get();
        return view('buddy.create',[
            'profiles' => $profiles
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
            'dive_count' => 'required',
            'buddy_id' => 'required',
            'message' => 'required',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('buddy.create')
                ->withInput()
                ->withErrors($validator);
        }

        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $result = Buddy::create($data);

        $profile = Profile::find(Auth::user()->id);
        $profile->increment('dive_count', $request->dive_count);

        session()->flash('status', '登録が完了しました');
        return redirect()->route('buddy.index');

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
        //
    }
}
