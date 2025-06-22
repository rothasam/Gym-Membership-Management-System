<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass; 

class ClassController extends Controller
{
    public function index() {

        $classes = GymClass::all();
        return view('classes.index', compact('classes'));
    }

    public function create () {

        return view('classes.create');
    }

    public function store(Request $request) {

        $request->validate([
           'class_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_member' => 'nullable|integer',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
        ]);

        GymClass::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }  
    
    public function show(GymClass $classes) {

        return view('classes.show', compact('classes'));
    }

    public function edit(GymClass $classes) {

        return view('classes.edit', compact('classes'));
    }

    public function  update(Request $request, GymClass $classes) {

        $request->validate([
            'class_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_member' => 'nullable|integer',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
        ]);

        $classes->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }


    public function destroy(GymClass $classes ) {

    //    $classes->deleted();

        // return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}
