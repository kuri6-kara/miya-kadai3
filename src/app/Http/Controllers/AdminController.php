<?php

namespace App\Http\Controllers;

use App\Http\Requests\Weight_logRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Weight_target;
use App\Models\Weight_log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $weight_targets = Weight_target::where('user_id', auth()->id())->first();
        // ユーザーの最新の体重ログを取得
        // 日付でソートして、最新のものを1件取得します
        $latest_weight_log = Weight_log::where('user_id', auth()->id())
            ->orderBy('date', 'desc') // 日付で降順ソート
            ->orderBy('id', 'desc')   // 同じ日付の場合はIDで降順ソート (念のため)
            ->first();
        // dump($latest_weight_log);
        // dump($weight_targets);

        // 現在の体重と目標体重の差異を計算
        // 空の箱を作成
        // $current_weight = null;
        // $weight_difference = null;

        // if ($latest_weight_log) {
        //     $current_weight = $latest_weight_log->weight;

        //     if ($weight_targets && $weight_targets->target_weight !== null) {
        // 目標体重 - 現在の体重 で差異を計算
        // マイナスの値は「目標まであと〇kg」
        // プラスの値は「目標を超過〇kg」
        $weight_difference = $latest_weight_log->weight - $weight_targets->target_weight;
        dump($weight_difference);
        //     }
        // }

        // 体重ログをページネート
        $weight_logs = Weight_log::where('user_id', auth()->id())->Paginate(9); // ユーザーのログのみ表示するよう変更

        return view('admin', compact('weight_targets', 'weight_logs', 'latest_weight_log', 'weight_difference'));
    }

    public function search(Request $request)
    {
        $query = Weight_log::query();

        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->input('start_date'));
            $query->where('date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->input('end_date'));
            $query->where('date', '<=', $endDate->endOfDay());
        }

        $weight_logs = $query->Paginate(9);
        return view('admin', compact('weight_logs'));
    }

    public function store(Weight_logRequest $request)
    {
        $weight_logs = Weight_log::create(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        return redirect('/weight_logs');
    }

    public function show($weight_logId)
    {
        $weight_log = Weight_log::find($weight_logId);
        return view('show', compact('weight_log'));
    }

    public function update(Weight_logRequest $request, $weight_logId)
    {
        $data = $request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        $weight_log = Weight_log::find($weight_logId);
        $weight_log->update($data);
        return redirect('/weight_logs');
    }

    public function destroy(Request $request, $weight_logId)
    {
        Weight_log::find($weight_logId)->delete();
        return redirect('/weight_logs');
    }
}
