<?php

namespace App\Http\Controllers;

use App\Http\Requests\Weight_logRequest;
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

        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->input('start_date'));
            $query->where('date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->input('end_date'));
            $query->where('date', '<=', $endDate->endOfDay());
        }


        $results = $query->get();

        $weight_logs = $query->Paginate(9);
    return view('admin', compact('weight_logs'));
    }

    public function store(Weight_logRequest $request)
    {
        $weight_logs = Weight_log::create(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        return redirect('/weight_logs');
    }

    public function show($weight_logId)
    {
        $weight_log = Weight_log::find($weight_logId);
        return view('show', compact('weight_log'));
    }

    public function update(Weight_logRequest $request, $weight_logId)
    {
        $data = $request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        $weight_log = Weight_log::find($weight_logId);
        $weight_log->update($data);
        return redirect('/weight_logs');
    }

    public function destroy(Request $request, $weight_logId)
    {
        Weight_log::find($weight_logId)->delete();
        return redirect('/weight_logs');
    }
}