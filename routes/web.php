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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\NewsController;

// prefix:Route設定するとき引数で指定したURLの配下に反映させられる
// admin配下のURLにfunctionの処理が反映される
Route::controller(NewsConroller::class)->prefix('admin')->group(function(){
    // /create にアクセスされるとNewsConrollerのaddメソッドの処理を実行する
    Route::get('news/create', 'add');
});

// PHP/Laravel 09 Routingについて理解する 課題3
Route::controller(AAAController::class)->prefix('admin')->group(function(){
 Route::get('test/create', 'bbb');
});

// PHP/Laravel 09 Routingについて理解する 課題4
Route::controller(ProfileController::class)->prefix('admin')->group(function(){
    Route::get('profile/create', 'add');
});

// PHP/Laravel 09 Routingについて理解する 課題4
Route::controller(ProfileController::class)->prefix('admin')->group(function(){
    Route::get('profile/edit', 'edit');
});
