<?php

namespace App\Http\Controllers;

use App\Models\DailyAttendance;
use App\Models\GymClass;
use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $t_member = Member::where('is_deleted',false)->count();
        $t_class = GymClass::where('is_deleted',false)->count();
        $t_staff = User::count();
        $t_revenue = Payment::sum('amount');
        // $t_attendance = DailyAttendance::whereDate('check_in', Carbon::today())->count();

        return view('dashboard.index', compact(
            't_member',
            't_class',
            't_staff',
            't_revenue'
        ));

    }
}
