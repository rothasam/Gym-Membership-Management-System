<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Display registration form
    public function create()
    {
        $plans = MembershipPlan::all(); 
        return view('members.create',compact('plans'));
    }
    
   public function store(Request $req)
    {
        if (!$req->has('payment_method') || empty($req->payment_method)) {
            $req->merge(['payment_method' => 'cash']); 
        }

        // Log basic validated input
        Log::info('Validated request: ' . json_encode($req->only([
            'first_name', 'last_name', 'gender', 'dob', 'phone', 'email', 'address',
            'membership_plan_id', 'start_date', 'price', 'payment_method'
        ])));

        $req->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,none',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:members,email',
            'address' => 'nullable|string',
            'is_deleted' => 'nullable',
            'membership_plan_id' => 'required|exists:membership_plans,membership_plan_id',
            'start_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank_transfer',
            'price' => 'required|numeric|min:0',
        ]);

        // Log::info('Validation passed.');

        // try {
            DB::transaction(function () use ($req) {

                // Log::info('Creating member...');
                $member = Member::create([
                    'first_name' => $req->first_name,
                    'last_name' => $req->last_name,
                    'gender' => $req->gender,
                    'dob' => $req->dob,
                    'phone' => $req->phone,
                    'email' => $req->email,
                    'address' => $req->address,
                    'joined_date' => now(),
                ]);
                // Log::info('Member created with ID: ' . $member->member_id);

                $plan = MembershipPlan::findOrFail($req->membership_plan_id);
                // Log::info('Plan selected: ' . $plan->membership_plan_id);

                $start = \Carbon\Carbon::parse($req->start_date);
                $end = $start->copy()->addMonths($plan->duration_month);
                // Log::info("Start date: {$start}, End date: {$end}");

                // Log::info('Creating plan subscription...');
                $sub = PlanSubscription::create([
                    'member_id' => $member->member_id,
                    'membership_plan_id' => $plan->membership_plan_id,
                    'start_date' => $start,
                    'end_date' => $end,
                    'status' => 'active',
                ]);
                // Log::info('Plan subscription created with ID: ' . $sub->plan_subscription_id);

                // Log::info('Creating payment...');
                $payment = Payment::create([
                    'plan_subscription_id' => $sub->plan_subscription_id,
                    'amount' => $req->price,
                    'payment_method' => $req->payment_method,
                    'paid_date' => now(),
                    'user_id' => 1, // temporary/test user
                ]);
                // Log::info('Payment created with ID: ' . $payment->payment_id);
            });

            Log::info('Transaction committed successfully.');
            return redirect()->route('members.index')->with('success', 'Member registered successfully!');

        // } catch (\Exception $e) {
        //     Log::error('Transaction failed with error: ' . $e->getMessage());
        //     Log::error('Trace: ' . $e->getTraceAsString());
        //     return back()->withErrors(['error' => 'Registration failed, please check logs.']);
        // }
    }



    public function index()
    {
        $members = Member::all()->where('is_deleted',false);
        $plans = MembershipPlan::all(); 
        return view('members.index', compact('members','plans'));
    }

    // Show single member
    public function show(Member $member)
    {
        $member->load([
            'planSubscriptions.membershipPlan',
            'payments.user',
            'dailyAttendances'
        ]);

        // $latestSubscription = $member->planSubscriptions()
        //     ->latest('start_date')  // or 'plan_subscription_id' if it's auto-increment
        //     ->with('membershipPlan')
        //     ->first();

        $latestPayment = Payment::whereHas('planSubscription', function ($query) use ($member) {
            $query->where('member_id', $member->member_id);
        })
        ->with('planSubscription.membershipPlan')
        ->latest('paid_date') // Get the most recent payment
        ->first();

        $latestSubscription = $latestPayment ? $latestPayment->planSubscription : null;

        return view('members.show', compact('member','latestSubscription'));
    }


    // Edit member form
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }


    public function update(Request $req, Member $member)
    {
        $validated = $req->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => ['nullable', 'email', Rule::unique('members')->ignore($member->member_id, 'member_id')],
            'address' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }



    // Delete member
    public function destroy(Member $member)
    {
        Log::info('Attempting to soft-delete member:', ['id' => $member->member_id]);
        $member->is_deleted = 1;
        $member->save();

        Log::info('Member deleted status updated:', ['id' => $member->member_id, 'is_deleted' => $member->is_deleted]);
        return redirect()->route('members.index')
                         ->with('success', 'Member deleted successfully!');
    }
}