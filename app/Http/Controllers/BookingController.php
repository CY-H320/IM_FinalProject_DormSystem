<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Equipment;

class BookingController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        
        // Fetch bookings for each equipment by equipment name
        foreach ($equipments as $equipment) {
            $bookings = Booking::where('name', $equipment->name)->get();
            $equipment->bookings = $bookings;
        }
        
        return view('equipments.index', compact('equipments'));
    }

    public function create()
    {
        $equipments = Equipment::all();
        return view('bookings.create', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'booked_by' => 'required|string|max:255',
        ]);

        Booking::create($request->all());

        return redirect()->route('equipments.index')
                         ->with('success', 'Booking created successfully.');
    }
}
