<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daily_attendances;

class DailyAttendanceController extends Controller
{
    public function index()
    {
        $attendances = daily_attendances::all();
        return view('daily_attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('daily_attendance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent'
        ]);

        daily_attendances::create($request->all());

        return redirect()->route('daily_attendance.index')->with('success', 'Attendance recorded successfully!');
    }

    public function show(daily_attendances $attendance)
    {
        return view('daily_attendance.show', compact('attendance'));
    }

    public function edit(daily_attendances $attendance)
    {
        return view('daily_attendance.edit', compact('attendance'));
    }
   
    public function update(Request $request, daily_attendances $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent'
        ]);

        $attendance->update($request->all());

        return redirect()->route('daily_attendance.index')->with('success', 'Attendance updated successfully!');
    }

    public function destoy(daily_attendances $attendance)
    {
        $attendance->delete();
        return redirect()->route('daily_attendance.index')->with('success', 'Attendance deleted successfully!');
    }
}
