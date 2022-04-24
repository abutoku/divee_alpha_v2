<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

//Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TideController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\SetdataController;
use App\Http\Controllers\BuddyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DivemapController;

//認証
use Illuminate\Support\Facades\Auth;

//Model
use App\Models\Location;
use App\Models\Buddy;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ユーザー認証されていないと表示されない設定
Route::group(['middleware' => 'auth'], function () {

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', function () {

    //管理者アカウントの場合は別ページへ
    if(Auth::user()->admin == true) {
        return view('config');
    }

    //未読通知
    $notice = Buddy::where('buddy_id',Auth::user()->id)
                    ->where('is_checked',false)
                    ->count();

    return view('dashboard',[
        'notice' => $notice,
    ]);
})->middleware(['auth'])->name('dashboard');

//-----post-------------------//
//Postにfavorit追加のルート
Route::post('post/{post}/favorites', [FavoriteController::class, 'store'])->name('favorites');
//Postのfavorit解除のルート
Route::post('post/{post}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

//my log のルート
Route::get('/post/mypage', [PostController::class, 'mydata'])->name('post.mypage');

Route::resource('post', PostController::class);

//-----profile-------------------//

//ステータス画面切り替え
Route::get('/profile/{profile}/list', [ProfileController::class,'list'])
->name('profile.list');
//プロフィール設定メニュー一覧
Route::get('/profile/menu', [ProfileController::class,'menu'])
->name('profile.menu');
//カバー画像変更画面
Route::get('/profile/{profile}/cover', [ProfileController::class,'cover'])
->name('profile.cover');
//カバー画像変更処理
Route::patch('/profile/{profile}/cover', [ProfileController::class,'coverchange'])
->name('profile.coverchange');

Route::resource('profile', ProfileController::class);

//-----picture-------------------//
//サムネイル変更のルート
Route::post('picture/{picture}/change', [PictureController::class,'change'])
->name('picture.change');

Route::resource('picture', PictureController::class);

//-----comment-------------------//
//comment storeへのルート
Route::post('post/{post}/comment', [CommentController::class,'store'])
->name('comment.store');
//comment destroyへのルート
Route::delete('comment/{comment}', [CommentController::class,'destroy'])
->name('comment.destroy');

//-----log-------------------//
Route::post('log/search', [LogController::class,'search'])
->name('log.search');

Route::resource('log', LogController::class);

//-----divemaps--------------//
Route::resource('divemap', DivemapController::class);

//-----book-------------------//
//図鑑MEMO更新
Route::get('book/{book}/memo', [BookController::class,'memo'])
->name('book.memo');

//図鑑選択画面へのルート
Route::get('book/{book}/select', [BookController::class,'select'])
->name('book.select');

//図鑑画像変更のルート
Route::post('book/{book}/change', [BookController::class,'change'])
->name('book.change');

Route::post('book/search', [BookController::class,'search'])
->name('book.search');

Route::resource('book', BookController::class);

//-----site------------------//
Route::resource('site', SiteController::class);

//-----setdata------------------//
Route::resource('setdata', SetdataController::class);

//-----buddy-----------------//
Route::resource('buddy', BuddyController::class);

//-----map-------------------//
//Map画面表示のルート（場所）
Route::get('/map/site', [MapController::class,'site'])->name('map.site');
//Mapから選択されたポイントのログを探す
Route::post('/map/getSiteLog',[MapController::class,'getSiteLog'])->name('map.getSiteLog');
//生物名検索ページ
Route::get('/map/fish',[MapController::class,'fish'])->name('map.fish');
//生物名で検索
Route::post('/map/search',[MapController::class,'search'])->name('map.search');
//Map画面表示のルート（投稿記事）
Route::get('/map/post', [MapController::class,'post'])->name('map.post');

//------tide-------------------//
//ページ表示
Route::get('/tide/info',[TideController::class,'info'])->name('tide.info');
//ポイント変更
Route::post('/tide/select',[TideController::class,'select'])->name('tide.select');

//------shop-------------------//
Route::resource('shop', ShopController::class);

//------setting-------------------//
//設定画面表示
Route::get('/setting/index',[SettingController::class,'index'])->name('setting.index');

//------back-------------------//
//店舗管理者
Route::get('/back/index',[BackController::class,'index'])->name('back.index');

//------master------------------//
//管理者ページ
Route::resource('master', MasterController::class);

});

//ユーザー認証ここまで


Route::get('/', function () {
    //3日以内の投稿を取得
    $nearday = Carbon::today()->subDay(3);
    $newposts = Location::whereDate('created_at','>=',$nearday)->get();
    return view('welcome',[
        'newposts' => $newposts,
    ]);
});


require __DIR__.'/auth.php';
