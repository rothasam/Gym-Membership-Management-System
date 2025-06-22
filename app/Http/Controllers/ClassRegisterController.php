<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRegisteration; 
use App\Models\Member; 
use App\Models\GymClass; 

class ClassRegisterController extends Controller
{
   public function index()
    {
        $registrations = ClassRegisteration::with(['member', 'class'])->latest()->get();
        return view('class_registrations.index', compact('registrations'));
    }

      public function create()
    {
        $members = Member::all();
        $classes = GymClass::all();
        return view('class_registrations.create', compact('members', 'classes'));
    }

      public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'class_id' => 'required|exists:classes,class_id',
            'registered_date' => 'required|date',
        ]);

        // Check if the registration already exists
        $existingRegistration = ClassRegisteration::where('member_id', $validated['member_id'])
            ->where('class_id', $validated['class_id'])
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'This member is already registered for this class.');
        }

        ClassRegisteration::create($validated);

        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration created successfully.');
    }

      public function show(ClassRegisteration $ClassRegisteration)
    {
        return view('class_registrations.show', compact('ClassRegisteration'));
    }


    public function edit(ClassRegisteration $ClassRegisteration)
    {
        $members = Member::all();
        $classes = GymClass::all();
        return view('class_registrations.edit', compact('ClassRegisteration', 'members', 'classes'));
    }

    public function update(Request $request, ClassRegisteration $ClassRegisteration)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'class_id' => 'required|exists:classes,class_id',
            'registered_date' => 'required|date',
        ]);

        // Check if the registration already exists
        $existingRegistration = ClassRegisteration::where('member_id', $validated['member_id'])
            ->where('class_id', $validated['class_id'])
            ->where('id', '!=', $ClassRegisteration->id)
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'This member is already registered for this class.');
        }

        $ClassRegisteration->update($validated);

        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration updated successfully.');
    }

    public function destroy(ClassRegisteration $ClassRegisteration)
    {
        $ClassRegisteration->delete();
        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration deleted successfully.');
    }
}
