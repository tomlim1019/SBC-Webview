<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\External;
use App\Models\Driver;

class BookingController extends Controller
{
    public function pendingRequest()
    {   
        $bookings = Booking::where('status', 'open')->get();

        return response()->json($bookings);
    }

    public function myRequest()
    {   
        $owner = Auth::user()->owner_id;
        $bookings = Booking::where('owner_id', $owner)->get();


        return response()->json($bookings);
    }

    public function acceptRequest(Request $request, $id)
    {
        $booking = Booking::find($id);
        $driver = Driver::find($request->driver['driver_id']);

        $driver->name = $request->driver['name'];
        $driver->mykad = $request->driver['mykad'];
        $driver->license = $request->driver['license'];
        $driver->phone = $request->driver['phone'];

        $booking->status = "booked";
        $booking->owner_id = Auth::user()->owner_id;
        //$booking->driver_id = $request->driver['driver_id'] + 0;
        //$booking->fleet_id = $request->fleet + 0;
        
        $booking->save();
        $driver->save();

        return response()->json($booking);
    }

    public function cancelRequest($id)
    {
        $booking = Booking::find($id);

        $booking->status = "open";
        $booking->owner_id = null;
        //$booking->driver_id = null;
        //$booking->fleet_id = null;
        $booking->changes = 0;

        $booking->save();

        return response()->json($booking);
    }

    public function completeRequest($id)
    {
        $booking = Booking::find($id);

        $booking->status = "completed";

        $booking->save();

        return response()->json($booking);
    }

    public function clearNotification()
    {
        $owner = Auth::user()->owner_id;
        $bookings = Booking::where('owner_id', $owner)->get();
        
        for($i = 0; $i < count($bookings); $i++){
            $bookings[$i]->changes = 0;
            $bookings[$i]->save();
        }

        return response()->json($bookings);
    }

    public function getFleet()
    {
        $owner = Auth::user()->owner_id;
        $fleet = External::where('owner_id', $owner)->get();

        return response()->json($fleet);
    }

    public function getDriver()
    {
        $owner = Auth::user()->owner_id;
        $driver = Driver::where('owner', $owner)->get();

        return response()->json($driver);
    }

    public function getNotification()
    {
        $owner = Auth::user()->owner_id;
        $booking = Booking::where('owner_id', $owner)->where('changes', 1)->get();

        return response()->json($booking);
    }
}
