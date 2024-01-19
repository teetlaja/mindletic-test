<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'psychologist_id' => 'required|exists:psychologists,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after_or_equal:now',
            'duration' => 'required|integer|min:60|max:540',
            'invoice_id' => 'nullable|exists:invoices,id',
        ]);

        // Convert the start_time to a DateTime instance
        $startTime = new \DateTime($validatedData['start_time']);

        // Check if the start time is before 9AM
        if ($startTime->format('H') < 9) {
            return response()->json(['error' => 'Start time cannot be before 9AM'], 400);
        }

        // Calculate the ending time
        $endTime = clone $startTime;
        $endTime->add(new \DateInterval('PT' . $validatedData['duration'] . 'M'));

        // Check if the ending time exceeds 6PM
        if ($endTime->format('H') > 18) {
            return response()->json(['error' => 'Ending time cannot exceed 6PM'], 400);
        }

        // Check if the psychologist has an ongoing booking at the same time
        $ongoingBooking = Booking::where('psychologist_id', $validatedData['psychologist_id'])
            ->where('start_time', '<=', $endTime)
            ->where('end_time', '>=', $startTime)
            ->exists();

        if ($ongoingBooking) {
            return response()->json(['error' => 'Psychologist has an ongoing booking at the same time'], 400);
        }

        $booking = Booking::create($validatedData);

        return response()->json(['booking' => $booking], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'psychologist_id' => 'required|exists:psychologists,id',
        'user_id' => 'required|exists:users,id',
        'start_time' => 'required|date|after_or_equal:now',
        'duration' => 'required|integer|min:60|max:540',
        'invoice_id' => 'nullable|exists:invoices,id',
    ]);

    $booking = Booking::findOrFail($id);
    $booking->update($validatedData);

    return response()->json(['booking' => $booking], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
