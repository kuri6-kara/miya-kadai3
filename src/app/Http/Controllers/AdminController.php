<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Weight_target;
use App\Models\Weight_log;

class AdminController extends Controller
{
    public function index()
    {
        $weight_targets = Weight_target::all();
        $weight_logs = weight_log::all();
        return view('admin', compact('weight_targets', 'weight_logs'));
    }
}

public function search(Request $request)
    {
        $startDate = $request->input('from');
        $endDate = $request->input('until');

        $results = Model::whereBetween('date', [$Weight_log])->get();

        return view('your.view', compact('results'));
    }