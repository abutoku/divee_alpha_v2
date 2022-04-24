<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        //dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        //gitできている
        // $user = Socialite::driver($provider)->user();
        // dd($user);
        try{
            $socialUser=Socialite::with($provider)->user();
            // dd($socialUser);
        }catch(\Exception $e){
            return redirect('/login');//失敗した場合
        }

        //User modelを使って検索
        $user = User::where([
            //provider_idをgetIdでとる
            'provider_id' => $socialUser->getId(),
            //プロバイダー名
            'provider_name' => $provider
        ])->first();

        if(!$user){
            $user = User::create([//ユーザーデータを作成
                'name'=> $socialUser->getName(),
                // 'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider_id'=> $socialUser->getId(),
                'provider_name'=> $provider
            ]);
        }

        //認証処理
        auth()->login($user,true);
        //処理後
        return redirect('/');
    }
}
