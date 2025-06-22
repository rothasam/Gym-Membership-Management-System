<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\class_registerations; 

class ClassRegisterController extends Controller
{
   public function index()
    {
        $registrations = ClassRegistration::with(['member', 'class'])->latest()->get();
        return view('class_registrations.index', compact('registrations'));
    }

      public function create()
    {
        $members = Member::all();
        $classes = ClassModel::all();
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
        $existingRegistration = ClassRegistration::where('member_id', $validated['member_id'])
            ->where('class_id', $validated['class_id'])
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'This member is already registered for this class.');
        }

        ClassRegistration::create($validated);

        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration created successfully.');
    }

      public function show(ClassRegistration $classRegistration)
    {
        return view('class_registrations.show', compact('classRegistration'));
    }


    public function edit(ClassRegistration $classRegistration)
    {
        $members = Member::all();
        $classes = ClassModel::all();
        return view('class_registrations.edit', compact('classRegistration', 'members', 'classes'));
    }

    public function update(Request $request, ClassRegistration $classRegistration)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'class_id' => 'required|exists:classes,class_id',
            'registered_date' => 'required|date',
        ]);

        // Check if the registration already exists
        $existingRegistration = ClassRegistration::where('member_id', $validated['member_id'])
            ->where('class_id', $validated['class_id'])
            ->where('id', '!=', $classRegistration->id)
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'This member is already registered for this class.');
        }

        $classRegistration->update($validated);

        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration updated successfully.');
    }

    public function destroy(ClassRegistration $classRegistration)
    {
        $classRegistration->delete();
        return redirect()->route('class-registrations.index')
                         ->with('success', 'Class registration deleted successfully.');
    }
}
