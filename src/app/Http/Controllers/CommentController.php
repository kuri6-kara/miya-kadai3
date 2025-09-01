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
        $weight_log = Weight_log::where('user_id', Auth::id())->findOrFail($weight_log_id);

        $comment = $weight_log->comment()->first();

        return view('comment', compact('weight_log', 'comment'));
    }

    public function store(Request $request, $weight_log_id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $weight_log = Weight_log::where('user_id', Auth::id())->findOrFail($weight_log_id);

        $comment = Comment::updateOrCreate(
            ['weight_log_id' => $weight_log->id, 'user_id' => Auth::id()],
            ['comment' => $request->input('comment')]
        );

        return redirect('/weight_logs');
    }
}
