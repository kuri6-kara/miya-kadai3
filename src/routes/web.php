<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

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



Route::middleware('auth')->group(function () {
    // AdminControllerの基本ルート
    Route::get('/weight_logs', [AdminController::class, 'index'])->name('index');
    // Route::get('/weight_logs/search', [AdminController::class, 'search']);
    Route::post('/weight_logs/create', [AdminController::class, 'store']);

    // 登録関連ルート
    Route::get('/register/step2', [RegisterController::class, 'create']);
    Route::post('/register/step2', [RegisterController::class, 'store']);

    // ★重要: GoalControllerのルートを、AdminControllerのワイルドカードルートより先に記述する★
    Route::get('/weight_logs/goal_setting/index', [GoalController::class, 'index']);
    Route::patch('/weight_logs/goal_setting/update', [GoalController::class, 'update']); // ★このPATCHルートを上に移動★

    // AdminControllerの動的ルート（{weight_log} はそのまま）
    Route::get('/weight_logs/{weight_log}', [AdminController::class, 'show']);
    Route::patch('/weight_logs/{weight_log}/update', [AdminController::class, 'update']);
    Route::delete('/weight_logs/{weight_log}/delete', [AdminController::class, 'destroy']);

    Route::get('/weight_logs/{weight_log}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/weight_logs/{weight_log}/comments', [CommentController::class, 'store']);
});
