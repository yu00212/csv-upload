<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ホーム画面
Route::get('/', [FileController::class, 'index']);
// CSVファイル登録
Route::post('/store', [FileController::class, 'store'])->name('csv.store');
// CSVファイル削除
