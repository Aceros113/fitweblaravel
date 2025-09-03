<?php

namespace App\Http\Controllers;

use App\Models\AttendanceCoach;
use Illuminate\Http\Request;

class AttendanceCoachController extends Controller
{
    public function index()
    {
        return AttendanceCoach::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'attendable_type' => 'required|string',
            'attendable_id' => 'required|integer',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'date' => 'required|date',
        ]);

        return AttendanceCoach::create($data);
    }
}

