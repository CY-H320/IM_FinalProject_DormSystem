<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Equipment;
use App\Models\Student;

class BookingController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();

        foreach ($equipments as $equipment) {
            $bookings = Booking::where('name', $equipment->name)->get();
            foreach ($bookings as $booking) {
                $student = Student::where('studentID', $booking->booked_by)->first();
                $booking->student = $student;
            }
            $equipment->bookings = $bookings;
        }

        return view('equipments.index', compact('equipments'));
    }

    public function public()
    {
        $equipments = Equipment::all();

        foreach ($equipments as $equipment) {
            $bookings = Booking::where('name', $equipment->name)->get();
            foreach ($bookings as $booking) {
                $student = Student::where('studentID', $booking->booked_by)->first();
                $booking->student = $student;
            }
            $equipment->bookings = $bookings;
        }

        return view('equipments.public', compact('equipments'));
    }


    public function create()
    {
        $equipments = Equipment::all();
        return view('bookings.create', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:equipments,name',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'student_id' => 'required|string|max:255',
        ]);

        // Find the equipment by name
        $equipment = Equipment::where('name', $request->name)->firstOrFail();

        Booking::create([
            'name' => $equipment->name,
            'start_time' => now()->format('Y-m-d') . ' ' . $request->start_time . ':00',
            'end_time' => now()->format('Y-m-d') . ' ' . $request->end_time . ':00',
            'booked_by' => $request->student_id,
        ]);

        return redirect()->route('equipments.index')->with('success', 'Booking created successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('equipments.index')->with('success', 'Booking deleted successfully.');
    }

    public function clean()
    {
        $today = today();
        $outdatedBookings = Booking::where('end_time', '<', $today)->get();
        foreach ($outdatedBookings as $booking) {
            $booking->delete();
        }
        return redirect()->back()->with('success', '過期借用已成功清理。');
    }
}
