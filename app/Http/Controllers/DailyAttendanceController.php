<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyAttendance;

class DailyAttendanceController extends Controller
{
    public function index()
    {
        $attendances = DailyAttendance::all();
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

        DailyAttendance::create($request->all());

        return redirect()->route('daily_attendance.index')->with('success', 'Attendance recorded successfully!');
    }

    public function show(DailyAttendance $attendance)
    {
        return view('daily_attendance.show', compact('attendance'));
    }

    public function edit(DailyAttendance $attendance)
    {
        return view('daily_attendance.edit', compact('attendance'));
    }
   
    public function update(Request $request, DailyAttendance $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent'
        ]);

        $attendance->update($request->all());

        return redirect()->route('daily_attendance.index')->with('success', 'Attendance updated successfully!');
    }

    public function destoy(DailyAttendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('daily_attendance.index')->with('success', 'Attendance deleted successfully!');
    }
}
