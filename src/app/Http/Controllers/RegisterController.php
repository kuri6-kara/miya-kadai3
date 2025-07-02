<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight_log;
use App\Models\Weight_target;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register_step2');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->only(['weight']);
        $data = $request->only(['target_weight']);
        $data['user_id'] = auth()->id();
        Weight_log::create($data);
        Weight_target::create($data);
        return redirect('/weight_logs');
    }
}
