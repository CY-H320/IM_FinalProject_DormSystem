<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    // PackageController.php

    public function index(Request $request)
    {
        // Get distinct room and bed values from the database
        $roomOptions = [101, 102, 103, 201, 202, 203];
        $bedOptions = ['A', 'B', 'C', 'D', 'E', 'F'];

        // Initialize query to retrieve all packages
        $query = Package::query();

        // Check if search parameters are provided
        if ($request->filled(['room'])) {
            // Apply search filters if provided
            if ($request->has('room')) {
                $query->where('room', $request->room);
            }
        }
        if ($request->filled(['bed'])) {
            if ($request->has('bed')) {
                $query->where('bed', $request->bed);
            }
        }

        $query->orderBy('date', 'desc');
        // Retrieve packages based on search filters
        $packages = $query->get();

        // Pass packages, search parameters, and options to view
        return view('packages.index', compact('packages', 'roomOptions', 'bedOptions'));
    }
    public function public(Request $request)
    {
        $roomOptions = [101, 102, 103, 201, 202, 203];
        $bedOptions = ['A', 'B', 'C', 'D', 'E', 'F'];

        $query = Package::query();

        if ($request->filled(['room'])) {
            if ($request->has('room')) {
                $query->where('room', $request->room);
            }
        }
        if ($request->filled(['bed'])) {
            if ($request->has('bed')) {
                $query->where('bed', $request->bed);
            }
        }

        $query->orderBy('date', 'desc');
        $packages = $query->get();
        return view('packages.public', compact('packages', 'roomOptions', 'bedOptions'));
    }


    // Method to show the add package form
    public function create()
    {
        return view('packages.create');
    }

    // Method to handle the submission of the add package form
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'date' => 'required',
            'room' => 'required',
            'bed' => 'required',
            'name' => 'required',
        ]);

        // Set error attribute based on other fields
        $error = ($request->filled(['room', 'bed', 'name'])) ? 0 : 1;

        // Add error attribute to validated data
        $validatedData['error'] = $error;

        // Create a new package record
        Package::create($validatedData);

        // Redirect back with success message
        return redirect()->route('package.create')->with('success', 'Package added successfully!');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully!');
    }
}
