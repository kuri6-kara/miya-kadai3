<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Weight_target;
use App\Models\Weight_log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $weight_targets = Weight_target::all();
        $weight_logs = Weight_log::all();
        return view('admin', compact('weight_targets', 'weight_logs'));
    }
}

public function search(Request $request)
    {
        $query = Weight_log::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $query->whereBetween('date', [$startDate, $endDate]);
    }

        $results = $query->get();

        return view('admin', compact('weight_logs'));
    }