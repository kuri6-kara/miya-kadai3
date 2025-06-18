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
