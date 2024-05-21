<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Visitor;
use App\Models\Equipment;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $rooms = [101, 102, 103, 201, 202, 203];
        $beds = ['A', 'B', 'C', 'D', 'E', 'F'];
        $floors = [1, 2, 3];

        $query = Student::query();

        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        if ($request->filled('floor')) {
            $query->whereRaw("FLOOR(room / 100) = ?", [$request->floor]);
        }

        if ($request->filled('studentID')) {
            $query->where('studentID', 'like', '%' . $request->studentID . '%');
        }

        $students = $query->get();

        $packageCounts = [];
        $visitorCounts = [];
        $bookingCounts = [];

        foreach ($students as $student) {
            $packageCount = Package::where('room', $student->room)
                                   ->where('bed', $student->bed)
                                   ->count();
            $packageCounts[$student->id] = $packageCount;
            $visitorCount = Visitor::where('room', $student->room)
                                ->where('bed', $student->bed)
                                ->count();
            $visitorCounts[$student->id] = $visitorCount;

            $bookingCount = Booking::where('booked_by', $student->studentID)
                                ->count();
            $bookingCounts[$student->id] = $bookingCount;
        }

        return view('students.index', compact('students', 'rooms', 'beds', 'floors','packageCounts', 'visitorCounts', 'bookingCounts'));
    }


    public function showDetails($id)
    {
        $student = Student::findOrFail($id);
        $packages = Package::where('room', $student->room)
                            ->where('bed', $student->bed)
                            ->get();
        $visitors = Visitor::where('room', $student->room)
        ->where('bed', $student->bed)
        ->get();
        $bookings = Booking::where('booked_by', $student->studentID)->get();
        return view('students.details', compact('student', 'packages', 'visitors', 'bookings'));
    }

    public function deletePackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->back()->with('success', 'Package deleted successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'studentID' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'room' => 'nullable|string|max:255',
            'bed' => 'nullable|string|max:255',
            'point' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('student.index')->with('success', '學生資料已更新');
    }

}
