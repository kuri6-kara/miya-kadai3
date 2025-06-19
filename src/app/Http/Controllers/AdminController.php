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
        $weight_logs = Weight_log::Paginate(9);
        return view('admin', compact('weight_targets', 'weight_logs'));
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

        $weight_logs = $query->Paginate(9);
    return view('admin', compact('weight_logs'));
    }

    public function update(Request $request, $weight_logId)
    {
        $data = $request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        $weight_log = Weight_log::find($weight_logId);
        $weight_log->update($data);
        return redirect('/weight_logs');
    }
}