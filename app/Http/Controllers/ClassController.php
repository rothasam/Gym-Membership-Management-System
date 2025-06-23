<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass; 

class ClassController extends Controller
{
    public function index() {


        // $classes = GymClass::all();
        $classes = GymClass::where('is_deleted', 0)->get();
        return view('classes.index', compact('classes'));
    }   

    public function add() {
    return view('classes.add'); 
    }

    public function create () {

        return view('classes.create');
        // return view('classes.add');
    }

    public function store(Request $request) {
        //  dd($request->all());
        
        $request->validate([
        //    'class_name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'total_member' => 'nullable|integer',
        //     'start_time' => 'nullable|date',
        //     'end_time' => 'nullable|date|after:start_time',
            'class_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_member' => 'nullable|integer',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
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

        $classes->update($request->all());        
        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }


    public function destroy(GymClass $classes ) {

        $classes->update(['is_deleted' => 1]);
        return redirect()->route('classes.index')->with('success', 'Class moved to trash successfully!');
    }
}
