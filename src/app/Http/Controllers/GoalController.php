<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_target;
use App\Http\Requests\GoalRequest; // GoalRequest が 'target_weight' をバリデーションすることを確認

class GoalController extends Controller
{
    public function index()
    {
        // ログインユーザーの目標体重を1件だけ取得
        // 存在しない場合は null が返る
        // dd('GoalController index reached');
        $weight_target = Weight_target::where('user_id', auth()->id())->first();

        // ビューに単一の weight_target オブジェクトを渡す
        return view('goal', compact('weight_target'));
    }

    public function update(GoalRequest $request) // ★$weight_targetId 引数を削除★
    {
        // dump('GoalController update method reached!'); // デバッグ用

        $data = $request->only(['target_weight']); // リクエストから 'target_weight' を取得
        $data['user_id'] = auth()->id(); // ログインユーザーのIDを追加

        // user_id が一致するレコードがあれば更新、なければ新規作成
        Weight_target::updateOrCreate(
            ['user_id' => auth()->id()], // 検索条件 (user_id でレコードを特定)
            $data                        // 更新または作成するデータ
        );

        // return redirect('/weight_logs');
        return redirect()->route('index');
    }
}
