<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;


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

// Route::middleware('auth')->group(function () {
//     Route::get('/weight_logs', [AuthController::class, 'index']);
// });

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [AdminController::class, 'index']);
    Route::get('/weight_logs/search', [AdminController::class, 'search']);
    Route::post('/weight_logs/create', [AdminController::class, 'store']);

    Route::get('/register/step2', [RegisterController::class, 'create']);
    Route::post('/register/step2', [RegisterController::class, 'store']);


    Route::get('/weight_logs/{weight_LogId}', [AdminController::class, 'show']);
    Route::patch('/weight_logs/{weight_LogId}/update', [AdminController::class, 'update']);
    Route::delete('/weight_logs/{weight_LogId}/delete', [AdminController::class, 'destroy']);

    Route::get('/weight_logs/goal_setting', [GoalController::class, 'index']);
    // ★ここを修正します！ GoalController の update ルートのURIを変更します。★
    // 例: 目標体重はユーザーごとに1つなので、IDは不要かもしれません。
    // または、goal_setting の下に update を置く。
    Route::patch('/weight_logs/goal_setting/update', [GoalController::class, 'update']);
    // もし GoalController の update が特定の目標IDを更新するなら、以下のようにすることも可能です。
    // Route::patch('/weight_targets/{targetId}', [GoalController::class, 'update']);
});
