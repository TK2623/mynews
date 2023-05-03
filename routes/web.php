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
Route::controller(NewsController::class)->prefix('admin')->group(function() {
    Route::get('news/create', 'add')->middleware('auth');
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
Route::controller(ProfileController::class)->prefix('admin')->group(function(){
    Route::get('profile/create', 'add');
    Route::get('profile/edit', 'edit');
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
