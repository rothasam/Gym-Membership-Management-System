<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPlan;

class MemebershipPlanController extends Controller
{

    // Display membership plans index page
    public function index() {
        return view('MembershipPlans.index');
    }

    // Display create membership plan provide to user Form 
    public function create() {
        return view('MembershipPlans.create');
    }

    // Store new membership plan
    public function store(Request $request) {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1', // Duration in months
        ]);

        MembershipPlan::create($request->all());

        return redirect()->route('MembershipPlans.index')->with('success', 'Membership plan created successfully!');
    }

    // Show single membership plan
    public function show(MembershipPlan $plan) {
        return view('MembershipPlans.show', compact('plan'));
    }

    // Edit membership plan form
    public function edit(MembershipPlan $plan) {
        return view('MembershipPlans.edit', compact('plan'));
    }

    // Update membership plan
    public function update(Request $request, MembershipPlan $plan) {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $plan->update($request->all());

        return redirect()->route('MembershipPlans.index')->with('success', 'Membership plan updated successfully!');
    }

    public function destroy(MembershipPlan $plan) {
        $plan->delete();
        return redirect()->route('MembershipPlans.index')->with('success', 'Membership plan deleted successfully!');
    }
}
