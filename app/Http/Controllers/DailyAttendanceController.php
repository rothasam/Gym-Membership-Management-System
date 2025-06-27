<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\DailyAttendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DailyAttendanceController extends Controller
{

    public function index()
    {
        $today = Carbon::today();

        // Load members with their latest subscription
        $members = Member::where('is_deleted', false)
            ->with(['latestSubscription.membershipPlan'])
            ->get()
            ->filter(function ($member) use ($today) {
                $sub = $member->latestSubscription;

                // Keep only if subscription exists and is still active
                return $sub && Carbon::parse($sub->end_date)->gte($today);
            });

        // add extra properties for use in the view (optional)
        foreach ($members as $member) {
            $sub = $member->latestSubscription;
            $end = Carbon::parse($sub->end_date);

            $member->status = 'active';
            $member->plan_name = $sub->membershipPlan->name ?? 'N/A';
            $member->end_date = $end->toDateString();
        }

        return view('daily_attendance.index', compact('members'));
    }

    public function store(Request $req)
    {
        Log::info('Check-in Request:', $req->all());
        $attendance = DailyAttendance::create([
            'member_id' => $req->member_id,
            'check_in' => now()
        ]);

        return redirect()->back()->with('success', 'Attendance submitted successfully!');

    }


}
