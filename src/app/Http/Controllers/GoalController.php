<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_target;


class GoalController extends Controller
{
    public function index()
    {
        $weight_targets = Weight_target::all();
        return view('goal', compact('weight_targets'));
    }

    public function update(Request $request, $weight_targetId)
    {
        $data = $request->only(['target_weight']);
        $weight_target = Weight_target::find($weight_targetId);
        $weight_target->update($data);
        return redirect('/weight_logs');
    }
}
