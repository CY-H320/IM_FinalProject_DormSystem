<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Package;

class StudentController extends Controller
{
    // Controller method responsible for rendering the view
    public function index(Request $request)
    {
        // Define options manually for beds
        $rooms = [101, 102, 103, 201, 202, 203];
        $beds = ['A', 'B', 'C', 'D', 'E', 'F']; // Example bed letters
        $floors = [1, 2, 3];

        // Initialize $students with all students
        $query = Student::query();

        // Check if there are any search criteria provided
        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        if ($request->filled('floor')) {
            // Assuming room is an integer and floor is the first digit of the room number
            $query->whereRaw("FLOOR(room / 100) = ?", [$request->floor]);
        }

        // Get the students matching the search criteria
        $students = $query->get();

        // Initialize an array to store the package counts for each student
        $packageCounts = [];

        // Loop through each student to count their packages
        foreach ($students as $student) {
            // Count the number of packages for the current student
            $packageCount = Package::where('room', $student->room)
                                   ->where('bed', $student->bed)
                                   ->count();

            // Store the package count for the current student
            $packageCounts[$student->id] = $packageCount;
        }
        $sortOrder = $request->input('sort_order', 'asc');

        // Pass the $students, $rooms, $beds, $floors, and $packageCounts variables to the view
        return view('students.index', compact('students', 'rooms', 'beds', 'floors', 'packageCounts'));
    }

    public function showDetails($id)
    {
        // Retrieve the student by ID
        $student = Student::findOrFail($id);

        // Retrieve packages for the student
        $packages = Package::where('room', $student->room)
                            ->where('bed', $student->bed)
                            ->get();

        // Return the student details view with the student and packages data
        return view('students.details', compact('student', 'packages'));
    }

    // Method to delete a package
    public function deletePackage($id)
    {
        // Find the package by ID
        $package = Package::findOrFail($id);

        // Delete the package
        $package->delete();

        // Redirect back to the student details page
        return redirect()->back()->with('success', 'Package deleted successfully.');
    }
}
