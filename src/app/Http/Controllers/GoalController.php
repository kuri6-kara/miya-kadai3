<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_target;
use App\Http\Requests\GoalRequest;

class GoalController extends Controller
{
    public function index()
    {
        $weight_targets = Weight_target::all();
        return view('goal', compact('weight_targets'));
    }

    public function update(GoalRequest $request, $weight_targetId)
    {
        $data = $request->only(['target_weight']);
        $weight_target = Weight_target::find($weight_targetId);
        $weight_target->update($data);
        return redirect('/weight_logs');
    }

    public function create()
    {
        return view('auth.register_step2');
    }
    public function store(GoalRequest $request)
    {
        $data = $request->only(['weight', 'target_weight']);
        $data['user_id'] = auth()->id();
        Weight_target::create($data);
        return redirect('/weight_logs');
    }
}
