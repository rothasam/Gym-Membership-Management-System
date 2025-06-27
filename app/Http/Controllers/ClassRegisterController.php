<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRegisteration; 
use App\Models\Member; 
use App\Models\GymClass;
use App\Models\PlanSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassRegisterController extends Controller
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

    //add extra properties for use in the view (optional)
    foreach ($members as $member) {
        $sub = $member->latestSubscription;
        $end = Carbon::parse($sub->end_date);

        $member->status = 'active';
        $member->plan_name = $sub->membershipPlan->name ?? 'N/A';
        $member->end_date = $end->toDateString();
    }

    // Get all classes (not deleted)
    $classes = GymClass::where('is_deleted', false)->get();

    return view('class_register.register', compact('members', 'classes'));
}



public function store(Request $request)
{
    
    $request->validate([
        'member_id' => 'required|exists:members,member_id',
        'class_ids' => 'required|array|min:1',
    ]);

    $memberId = $request->member_id;
    $classIds = $request->class_ids;

    $subscription = PlanSubscription::where('member_id', $memberId)
        ->where('status', 'active')
        ->whereDate('end_date', '>=', Carbon::today())
        ->latest('end_date')
        ->first();

    if (!$subscription) {
        return back()->withErrors(['error' => 'Member does not have an active subscription.']);
    }

    $allowed = $subscription->membershipPlan->total_class;
    $used = ClassRegisteration::where('member_id', $memberId)
    ->where('registered_date', '>=', $subscription->start_date)
    ->where('registered_date', '<=', $subscription->end_date)
    ->where('is_deleted', false)
    ->count();

    $remaining = $allowed - $used;

    if (count($classIds) > $remaining) {
        return back()->withErrors(['error' => 'You are trying to register for too many classes.']);
    }

    // Pre-check all classes
    foreach ($classIds as $classId) {
        $class = \App\Models\GymClass::find($classId);
        if (!$class) {
            return back()->withErrors(['error' => "Class ID $classId not found."]);
        }

        // $registered = ClassRegisteration::where('gym_class_id', $classId)
        //     ->where('is_deleted', false)
        //     ->count();

        // if ($registered >= $class->total_member) {
        //     return back()->withErrors(['error' => "Class {$class->class_name} is already full."]);
        // }

        $today = \Carbon\Carbon::today();

$registered = ClassRegisteration::where('gym_class_id', $class->gym_class_id)
    ->whereDate('registered_date', $today)
    ->where('is_deleted', false)
    ->count();

        if ($registered >= $class->total_member) {
            return back()->withErrors(['error' => "Class {$class->class_name} is already full."]);
        }


        // $alreadyRegistered = ClassRegisteration::where('member_id', $memberId)
        //     ->where('gym_class_id', $classId)
        //     ->where('is_deleted', false)
        //     ->exists();

        // if ($alreadyRegistered) {
        //     return back()->withErrors(['error' => "Member already registered to {$class->class_name}."]);
        // }

        

        
    }

    // All checks passed, perform inserts
    DB::beginTransaction();
Log::info("Member $memberId allowed: $allowed, used: $used, remaining: $remaining");

    try {
        foreach ($classIds as $classId) {
            ClassRegisteration::create([
                'member_id' => $memberId,
                'gym_class_id' => $classId,
                'registered_date' => now(),
            ]);
        }

        DB::commit();
        return redirect()->route('class_register.index')->with('success', 'Member registered successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Registration failed. Please try again.']);
    }
}




}
