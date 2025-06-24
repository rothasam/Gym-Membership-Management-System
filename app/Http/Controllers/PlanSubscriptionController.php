<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\PlanSubscription;
use Illuminate\Http\Request;

class PlanSubscriptionController extends Controller
{
    public function checkPlanStatus($query){
        return $query->where('status', 'active')
                 ->where('end_date', '>', now());



        // show expired
        // return $this->hasOne(PlanSubscription::class, 'member_id')
        //         ->where('status', 'active')
        //         ->orderByDesc('created_at');
    }

    public function createSubscription(Request $req){
        $req->validate([
            'member_id' => 'required|exists:members,member_id',
            'membership_plan_id' => 'required|exists:membership_plan,membership_plan_id',
        ]);

        $plan = MembershipPlan::find($req->membership_plan_id);

        PlanSubscription::create([
            'member_id' => $req->member_id,
            'membership_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration), // assume 'duration' is in days
            'status' => 'active',
        ]);

        return back()->with('success', 'Subscription added.');

    }

    
}
