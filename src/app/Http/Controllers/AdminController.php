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
        // $current_weight と $weight_difference を必ず初期化する
        $current_weight = null;
        $weight_difference = null;

        // 最新の体重ログが存在する場合のみ、現在の体重を設定し、差異を計算
        if ($latest_weight_log) {
            $current_weight = $latest_weight_log->weight; // 最新の体重を設定

            if ($weight_targets && $weight_targets->target_weight !== null) {
                // 目標体重 - 現在の体重 で差異を計算
                // マイナスの値は「目標まであと〇kg」
                // プラスの値は「目標を超過〇kg」
                $weight_difference = $current_weight - $weight_targets->target_weight;
                dump($weight_difference);
            }
        }

        // 体重ログをページネート
        $weight_logs = Weight_log::where('user_id', auth()->id())->Paginate(9); // ユーザーのログのみ表示するよう変更

        return view('admin', compact('weight_targets', 'weight_logs', 'latest_weight_log', 'current_weight', 'weight_difference'));
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
        // 以前のやり取りで修正した内容を適用します
        // Weight_log に保存するデータ
        $weightLogData = $request->only(['weight', 'calories', 'exercise_time', 'exercise_content']);
        $weightLogData['user_id'] = auth()->id();
        $weightLogData['date'] = Carbon::now()->toDateString(); // 今日の日付を自動登録

        // Weight_target に保存するデータ（もしフォームで目標体重も送信している場合）
        // もし目標体重がこのフォームで送信されていないなら、この部分は削除してください。
        // RegisterRequest に target_weight のバリデーションがあるなら、フォームにも必要です。
        // ここでは、目標体重は別のフォームで設定済みと仮定し、このstoreメソッドでは扱わない方がシンプルかもしれません。
        // もし、このstoreメソッドで目標体重も更新するなら、以下のようにします。
        // $targetWeightData = $request->only(['target_weight']);
        // $targetWeightData['user_id'] = auth()->id();
        // Weight_target::updateOrCreate(['user_id' => auth()->id()], $targetWeightData);
        // updateOrCreate を使うことで、既存の目標体重があれば更新、なければ新規作成します。

        Weight_log::create($weightLogData); // 修正後のデータで作成

        return redirect('/weight_logs');
    }

    public function show(Weight_log $weight_log)
    {
        // dd('AdminController show method reached with ID: ' . $weight_log);
        // $weight_log = Weight_log::find($weight_logId);
        return view('show', compact('weight_log'));
    }


    public function update(Weight_logRequest $request, Weight_log $weight_log)
    {
        dump('update');
        // dd('AdminController update method reached!');
        $data = $request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        // $weight_log = Weight_log::find($weight_log);
        $weight_log->update($data);
        // dd('update');
        return redirect('/weight_logs');
    }

    public function destroy(Request $request, Weight_log $weight_log)
    {
        // Weight_log::find($weight_logId)->delete();
        $weight_log->delete();
        return redirect('/weight_logs');
    }
}
