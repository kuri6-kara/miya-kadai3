<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_log;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメントページを表示します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $weight_log_id
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $weight_log_id)
    {
        // weight_log_idと認証済みユーザーIDに紐づくWeightLogを取得
        $weight_log = Weight_log::where('user_id', Auth::id())->findOrFail($weight_log_id);

        // その日のWeightLogに紐づくすべてのコメントを取得
        $comments = Comment::where('weight_log_id', $weight_log->id)->get();

        return view('comment', compact('weight_log', 'comments'));
    }

    /**
     * 新しいコメントを保存し、同じページにリダイレクトします。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $weight_log_id
     * @return \Illuminate\Http\RedirectResponse
     */
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
