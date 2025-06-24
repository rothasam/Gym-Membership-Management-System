<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Display registration form
    public function create()
    {
        return view('members.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,none',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email',
            'address' => 'nullable|string',
            'joined_date' => 'required|date',
            // 'membership_plan_id' => 'required|exists:membership_plans,id',
            // 'payment_method' => 'required|in:cash,aba_pay',
        ]);

        $member = Member::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'joined_date' => $request->joined_date,
        ]);

       // subscription

        return redirect()->route('members.index')->with('success', 'Member registered successfully!');
    }


    // List all members
    // public function index()
    // {
    //     $members = Member::all();
    //     return view('members.index', compact('members'));
    // }

    public function index()
    {
        $members = Member::with(['latestSubscription.membershipPlan'])->get();

        return view('members.index', compact('members'));
    }

    // Show single member
    public function show(Member $member)
    {
        
        return view('members.show', compact('member'));
    }


    // Edit member form
    public function edit(Member $member)
    {
        // $member = Member::findOrFail($member); 

        // return view('members.edit', compact('member')); 
        return view('members.edit', compact('member'));
        // return view('members.edit', compact('member'));
    }

    // Update member
    public function update(Request $request, Member $member)
    {
        // $validated = $request->validate([
        //     'first_name' => 'required|string|max:50',
        //     'last_name' => 'required|string|max:50',
        //     'gender' => 'required|in:male,female',
        //     'dob' => 'required|date|before_or_equal:today',
        //     'phone' => 'required|string|max:20',
        //     'email' => [
        //         'required',
        //         'email',
        //         'max:100',
        //         Rule::unique('members')->ignore($member->member_id, 'member_id')
        //     ],
        //     'address' => 'nullable|string',
        //     'joined_date' => 'required|date'
        // ]);

        // $member->update($validated);
        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');

        // return redirect()->route('members.show', $member)
        //                  ->with('success', 'Member updated successfully!');
    }

    // Delete member
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')
                         ->with('success', 'Member deleted successfully!');
    }
}