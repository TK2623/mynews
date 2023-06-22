<?php

use Illuminate\Support\Facades\Route;


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

// ControllerやActionを指定せずに直接Viewファイルを表示する
Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\Admin\NewsController;

// prefix:Route設定するとき引数で指定したURLの配下に反映させられる
// admin配下のURLにfunctionの処理が反映される
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});



// シンプルに書いたパターン
// Route::get('/admin/news/create',[NewsController::class,'add2']);


// PHP/Laravel 09 Routingについて理解する 課題3
use App\Http\Controllers\AAAController;
Route::controller(AAAController::class)->group(function(){
 Route::get('XXX', 'bbb');
});

// 課題3 シンプルに書いたパターン
// Route::get('/XXX',[AAAController::class,'bbb']);


// PHP/Laravel 09 Routingについて理解する 課題4
use App\Http\Controllers\Admin\ProfileController;

// PHP/Laravel 12 ユーザー認証を実装する 課題2
// URLによっては認証したり、しない場合があるのでそれぞれに記述
Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('profile/create', 'add')->name('profile.add');
    Route::post('profile/create', 'create')->name('profile.create');
    Route::get('profile', 'index')->name('profile.index');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});

// 課題4 シンプルに書いたパターン
// Route::get('admin/profile/create',[ProfileController::class,'add']);
// Route::get('admin/profile/edit',[ProfileController::class,'edit']);


// 入れ子で書いたパターン
// Route::prefix('admin')->group(function (){
//     Route::controller(NewsController::class)->prefix('news')->group(function (){
//         // /admin/news/create -> add()    
//     });
//     Route::controller(ProfileController::class)->prefix('profile')->group(function (){
//         // /admin/profile/edit -> edit()
//         Route::get('edit', 'edit');
//     });
    
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\NewsController as publicNewsController;
Route::get('/', [PublicNewsController::class, 'index'])->name('news.index');
