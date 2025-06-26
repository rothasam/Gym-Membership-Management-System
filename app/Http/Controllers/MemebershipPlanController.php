<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPlan;

class MemebershipPlanController extends Controller
{

   // In MemebershipPlanController.php
public function index() {
    $plans = MembershipPlan::where('is_deleted', false)->get();
    return view('plans.index', compact('plans')); // Changed from 'members.create' to 'plans.index'
}
            

    // Display create membership plan form
    public function create() {
        return view('plans.create');
    }

    // Store new membership plan
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_month' => 'required|integer|min:1',
            'total_class' => 'nullable|integer|min:0',
        ]);

        MembershipPlan::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration_month' => $request->duration_month,
            'total_class' => $request->total_class,
            'is_deleted' => false
        ]);

        return redirect()->route('plans.index')->with('success', 'Membership plan created successfully!');
    }

    // Show single membership plan
    public function show(MembershipPlan $plan) {
        return view('plans.show', compact('plan'));
    }

    // Edit membership plan form
    public function edit(MembershipPlan $plan) {
        return view('plans.edit', compact('plan'));
    }

    // Update membership plan
    public function update(Request $request, MembershipPlan $plan) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_month' => 'required|integer|min:1',
            'total_class' => 'nullable|integer|min:0',
        ]);

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'Membership plan updated successfully!');
    }

    public function destroy(MembershipPlan $plan) {
        $plan->update(['is_deleted' => true]);
        return redirect()->route('plans.index')->with('success', 'Membership plan deleted successfully!');
    }
    
}
