<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Student;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $roomOptions = [101, 102, 103, 201, 202, 203];
        $bedOptions = ['A', 'B', 'C', 'D', 'E', 'F'];

        $query = Package::query();

        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        $query->orderBy('date', 'desc');
        $packages = $query->get();

        foreach ($packages as $package) {
            $student = Student::where('room', $package->room)
            ->where('bed', $package->bed)
            ->first();
            $package->student = $student;
        }

        return view('packages.index', compact('packages', 'roomOptions', 'bedOptions'));
    }

    public function public(Request $request)
    {
        $roomOptions = [101, 102, 103, 201, 202, 203];
        $bedOptions = ['A', 'B', 'C', 'D', 'E', 'F'];

        $query = Package::query();

        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        $query->orderBy('date', 'desc');
        $packages = $query->get();

        return view('packages.public', compact('packages', 'roomOptions', 'bedOptions'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'room' => 'required',
            'bed' => 'required',
            'name' => 'required',
        ]);

        $error = ($request->filled(['room', 'bed', 'name'])) ? 0 : 1;
        $validatedData['error'] = $error;

        Package::create($validatedData);

        return redirect()->route('package.create')->with('success', 'Package added successfully!');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully!');
    }
}
