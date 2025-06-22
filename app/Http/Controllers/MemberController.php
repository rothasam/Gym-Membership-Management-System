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

    // Store new member
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before_or_equal:today',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:members,email',
            'address' => 'nullable|string',
            'joined_date' => 'required|date|after_or_equal:today'
        ]);

        Member::create($validated);

        return redirect()->route('members.register')
                         ->with('success', 'Member registered successfully!');
    }

    // List all members
    public function index()
    {
        $members = Member::orderBy('joined_date', 'desc')->paginate(10);
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
        return view('members.edit', compact('member'));
    }

    // Update member
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before_or_equal:today',
            'phone' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('members')->ignore($member->member_id, 'member_id')
            ],
            'address' => 'nullable|string',
            'joined_date' => 'required|date'
        ]);

        $member->update($validated);

        return redirect()->route('members.show', $member)
                         ->with('success', 'Member updated successfully!');
    }

    // Delete member
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')
                         ->with('success', 'Member deleted successfully!');
    }
}