<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gym_class; 

class ClassController extends Controller
{
    public function index() {

        $classes = gym_class::all();
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

        gym_class::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }  
    
    public function show(gym_class $classes) {

        return view('classes.show', compact('classes'));
    }

    public function edit(gym_class $classes) {

        return view('classes.edit', compact('classes'));
    }

    public function  update(Request $request, gym_class $classes) {

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


    public function destroy(gym_class $classes ) {

       $classes->deleted();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}
