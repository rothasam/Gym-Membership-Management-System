<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\membership_plan;

class MemebershipPlanController extends Controller
{

    // Display membership plans index page
    public function index() {
        return view('membership_plans.index');
    }

    // Display create membership plan provide to user Form 
    public function create() {
        return view('membership_plans.create');
    }

    // Store new membership plan
    public function store(Request $request) {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1', // Duration in months
        ]);

        membership_plan::create($request->all());

        return redirect()->route('membership_plans.index')->with('success', 'Membership plan created successfully!');
    }

    // Show single membership plan
    public function show(membership_plan $plan) {
        return view('membership_plans.show', compact('plan'));
    }

    // Edit membership plan form
    public function edit(membership_plan $plan) {
        return view('membership_plans.edit', compact('plan'));
    }

    // Update membership plan
    public function update(Request $request, membership_plan $plan) {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $plan->update($request->all());

        return redirect()->route('membership_plans.index')->with('success', 'Membership plan updated successfully!');
    }

    public function destroy(membership_plan $plan) {
        $plan->delete();
        return redirect()->route('membership_plans.index')->with('success', 'Membership plan deleted successfully!');
    }
}
