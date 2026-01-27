<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

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

//Route::get('/', function () {
    //return view('welcome');
//});

// 入力画面
Route::get('/', [ContactController::class, 'index']);

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm']);

// 保存処理
Route::post('/thanks', [ContactController::class, 'store']);

// 管理画面のメイン（検索・一覧）
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/search',[AdminController::class,'search']);
Route::post('/delete/{id}',[ContactController::class,'destroy']);