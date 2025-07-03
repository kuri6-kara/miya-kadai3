<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_log;
use App\Models\Weight_target;
use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register_step2');
    }

    public function store(RegisterRequest $request)
    {
        // --- 1. Weight_log に保存するデータを準備 ---
        // リクエストから 'weight' のみを取得
        $weightLogData = $request->only(['weight']);
        // 認証ユーザーのIDを追加
        $weightLogData['user_id'] = auth()->id();
        // ★ここに今日の日付を追加★
        $weightLogData['date'] = Carbon::now()->toDateString(); // 例: '2025-07-03' の形式で設定

        // --- 2. Weight_target に保存するデータを準備 ---
        // リクエストから 'target_weight' のみを取得
        $weightTargetData = $request->only(['target_weight']);
        // 認証ユーザーのIDを追加 (Weight_target にも user_id が必要であれば)
        $weightTargetData['user_id'] = auth()->id();

        // --- 3. それぞれのモデルを作成 ---
        // Weight_log モデルには $weightLogData を渡して作成
        Weight_log::create($weightLogData);

        // Weight_target モデルには $weightTargetData を渡して作成
        Weight_target::create($weightTargetData);

        return redirect('/weight_logs');
    }
}
