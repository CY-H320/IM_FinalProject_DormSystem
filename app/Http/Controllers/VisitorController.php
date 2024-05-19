<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Student;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomOptions = Visitor::distinct()->pluck('room');
        $bedOptions = Visitor::distinct()->pluck('bed');

        $query = Visitor::query();

        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        $visitors = $query->get()->map(function ($visitor) {
            $student = Student::where('room', $visitor->room)
                              ->where('bed', $visitor->bed)
                              ->first();

            $visitor->student_name = $student ? $student->name : 'Unknown';
            $visitor->student_id = $student ? $student->studentID : 'Unknown';

            return $visitor;
        });

        return view('visitors.index', compact('visitors', 'roomOptions', 'bedOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitors.create');
    }

    public function publicCreate()
    {
        return view('visitors.publicCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'visitorName' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'student_id' => 'required',
            'room' => 'required|string|max:255',
            'bed' => 'required|string|max:255',
        ]);

        // Set visit_time to the current timestamp
        $visitorData = $request->all();
        $visitorData['visit_time'] = now();

        Visitor::create($visitorData);

        return redirect()->route('visitors.index')
                        ->with('success', 'Visitor created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')
                         ->with('success', 'Visitor deleted successfully.');
    }

    public function publicStore(Request $request)
    {
        $request->validate([
            'visitorName' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'student_id' => 'required',
            'room' => 'required|string|max:255',
            'bed' => 'required|string|max:255',
        ]);

        $visitorData = $request->all();
        $visitorData['visit_time'] = now();

        Visitor::create($visitorData);

        return redirect()->route('visitors.publicCreate')
                        ->with('success', 'Visitor created successfully.');
    }
}
