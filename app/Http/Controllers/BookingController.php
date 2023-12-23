<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookingList = Booking::get();
        return view('index',compact('bookingList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookingPage');
    }


    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'booking_type' => 'required|in:Full Day,Half Day',
        'booking_date' => 'required|date',
        'booking_slot' => 'required|in:Morning,Evening',
        'booking_time' => 'required',
    ]);
    $existingBookings = Booking::where('booking_date', $request->booking_date)->get();
    if(!empty($existingBookings[0])) {
        foreach ($existingBookings as $booking) {
            if ($booking->booking_type === 'Full Day') {
                return redirect()->back()->with('error', 'Full Day booking already exists for this date');
            }

            if ($booking->booking_type === 'Half Day' && $request->booking_type === 'Full Day') {
                return redirect()->back()->with('error', 'Half Day booking already exists for this date, Full Day not allowed');
            }

            if ($booking->booking_slot === $request->booking_slot) {
                return redirect()->back()->with('error', $request->booking_slot . ' slot already booked for this date');
            }
        }
    }
    $data =  [
        'name' => $request->name,
        'email' => $request->email,
        'booking_type' => $request->booking_type,
        'booking_date' => $request->booking_date,
        'booking_slot' => $request->booking_slot,
        'booking_time' => $request->booking_time,
    ];
    
    // Create the booking only if no conflicts were found
    Booking::create($data);
    return redirect()->route('booking.index')->with("success", "Record added successfully");
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $bookingItem = Booking::find($id);
        return view('bookingShow', compact('bookingItem'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $bookingItem = Booking::find($id);
        return view('bookingEdit', compact('bookingItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'booking_type' => 'required|in:Full Day,Half Day',
            'booking_date' => 'required|date',
            'booking_slot' => 'required|in:Morning,Evening',
            'booking_time' => 'required',
        ]);
        $update = Booking::find($id);
        $existingBookings = Booking::where('booking_date', $update->booking_date)->get();
        if(!empty($existingBookings[0])) {
            foreach ($existingBookings as $booking) {
                if ($booking->booking_type === 'Full Day') {
                    return redirect()->back()->with('error', 'Full Day booking already exists for this date');
                }

                if ($booking->booking_type === 'Half Day' && $request->booking_type === 'Full Day') {
                    return redirect()->back()->with('error', 'Half Day booking already exists for this date, Full Day not allowed');
                }

                if ($booking->booking_slot === $request->booking_slot) {
                    return redirect()->back()->with('error', $request->booking_slot . ' slot already booked for this date');
                }
            }
        }
        $data =  [
            'name' => $request->name,
            'email' => $request->email,
            'booking_type' => $request->booking_type,
            'booking_date' => $request->booking_date,
            'booking_slot' => $request->booking_slot,
            'booking_time' => $request->booking_time,

        ];
        $update->update($data);
        return redirect()->route('booking.index')->with("success", "Record Updated successfully");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Booking::find($id);
        $delete->delete();
        return redirect()->back()->with("success", "Record deleted successfully");;
    }
}
