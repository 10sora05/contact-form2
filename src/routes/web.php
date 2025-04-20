<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// 管理画面：ログインが必要
Route::middleware('auth')->group(function () {
Route::get('/admin', [ContactController::class, 'admin'])->name('admin.index');
Route::post('/admin', [ContactController::class, 'store']);
Route::get('/admin/search', [ContactController::class, 'search'])->name('admin.search');
});

// 一般ユーザー向け画面：誰でもアクセス可能
Route::get('/', [ContactController::class, 'index']);
Route::get('contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');  // 確認画面
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');  // データ保存
Route::post('/submit', [UserController::class, 'store'])->name('submit');
Route::get('/thanks', function() {
    return view('thanks');
})->name('thanks');
Route::get('/', function () {
    return view('index', [
        'first_name' => session('first_name'),
        'given_name' => session('given_name'),
        'gender' => session('gender'),
        'email' => session('email'),
        'tel1' => session('tel1'),
        'tel2' => session('tel2'),
        'tel3' => session('tel3'),
        'address' => session('address'),
        'building' => session('building'),
        'detail' => session('detail'),
        'content' => session('content'),
    ]);
})->name('index');
