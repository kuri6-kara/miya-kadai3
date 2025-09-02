<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_log;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request, $weight_log_id)
    {
        // weight_log_idと認証済みユーザーIDに紐づくWeightLogを取得
        $weight_log = Weight_log::where('user_id', Auth::id())->findOrFail($weight_log_id);
dump($weight_log->comment);
        // その日のWeightLogに紐づくすべてのコメントを取得
        // 新しいコメントが一番上に表示されるように並べ替え
        // $comments = Comment::where('weight_log_id', $weight_log->id)->orderBy('created_at', 'desc')->get();

        return view('comment', compact('weight_log'));
    }


    public function store(Request $request, $weight_log_id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $weight_log = Weight_log::where('user_id', Auth::id())->findOrFail($weight_log_id);

        Comment::create([
            'user_id' => Auth::id(),
            'weight_log_id' => $weight_log->id,
            'comment' => $request->input('comment')
        ]);

        // コメント送信後、体重管理画面に戻るのではなく、コメントページへリダイレクト
        return redirect()->route('comments.index', ['weight_log' => $weight_log_id]);
    }
}
