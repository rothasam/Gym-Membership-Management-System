<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlanSubscriptionController extends Controller
{
    // public function checkPlanStatus($query){
    //     return $query->where('status', 'active')
    //              ->where('end_date', '>', now());



    //     // show expired
    //     // return $this->hasOne(PlanSubscription::class, 'member_id')
    //     //         ->where('status', 'active')
    //     //         ->orderByDesc('created_at');
    // }

    // public function createSubscription(Request $req){
    //     $req->validate([
    //         'member_id' => 'required|exists:members,member_id',
    //         'membership_plan_id' => 'required|exists:membership_plan,membership_plan_id',
    //     ]);

    //     $plan = MembershipPlan::find($req->membership_plan_id);

    //     PlanSubscription::create([
    //         'member_id' => $req->member_id,
    //         'membership_plan_id' => $plan->id,
    //         'start_date' => now(),
    //         'end_date' => now()->addDays($plan->duration), // assume 'duration' is in days
    //         'status' => 'active',
    //     ]);

    //     return back()->with('success', 'Subscription added.');

    // }


    public function upgradePlan(Request $request)
    {
        //  Log::info('Upgrade Plan Request Received:', $request->all());
        $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'membership_plan_id' => 'required|exists:membership_plans,membership_plan_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_method' => 'required|in:cash,bank_transfer',
        ]);

        $plan = MembershipPlan::findOrFail($request->membership_plan_id);

        $start = \Carbon\Carbon::parse($request->start_date);
        $end = $start->copy()->addMonths($plan->duration_month);

        $subscription = PlanSubscription::create([
            'member_id' => $request->member_id,
            'membership_plan_id' => $plan->membership_plan_id,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active',
        ]);

        Payment::create([
            'plan_subscription_id' => $subscription->plan_subscription_id,
            'amount' => $plan->price,
            'payment_method' => $request->payment_method,
            'paid_date' => now(),
            'user_id' =>  1,
        ]);

        return redirect()->route('members.index')->with('success', 'Plan upgraded successfully.');
    }



    
}
