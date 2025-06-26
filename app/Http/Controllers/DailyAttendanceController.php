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
                    ->get();


        foreach ($members as $member) {
            $sub = $member->latestSubscription;

            if ($sub) {
                // Use end_date to determine expiration
                $end = Carbon::parse($sub->end_date);

                // Add dynamic properties to the model for view use
                $member->subscription_status = $end->gte($today) ? 'active' : 'expired';
                $member->subscription_name = $sub->membershipPlan->name ?? 'N/A';
                $member->subscription_end = $end->toDateString();
            } else {
                $member->subscription_status = 'none';
                $member->subscription_name = 'No Subscription';
                $member->subscription_end = 'N/A';
            }
        }

        return view('daily_attendance.index', compact('members'));
    }

    public function create()
    {
        // return view('daily_attendance.create');
    }

    public function store(Request $req)
    {
        Log::info('Check-in Request:', $req->all());
        $attendance = DailyAttendance::create([
            'member_id' => $req->member_id,
            'check_in' => now()
        ]);

        return redirect()->back()->with('success', 'Check-in successful!');
    }


    public function destoy(DailyAttendance $attendance)
    {
        // $attendance->delete();
        // return redirect()->route('daily_attendance.index')->with('success', 'Attendance deleted successfully!');
    }
}
