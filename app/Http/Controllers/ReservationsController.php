<?php

namespace App\Http\Controllers;

use App\reservations;
use Illuminate\Http\Request;
use Calendar;

class ReservationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show calendar
        return view('calendar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        //get Reservations
        $reservations = reservations::all();
        $reservation_list = [];
        foreach ($reservations as $key => $reservation) {
            if ($reservation->canceld == false)
                $reservation_list[] = Calendar::event(
                    $reservation->reservation_name, // reservation title
                    false, // allday
                    new \DateTime($reservation->start), // reservation start
                    new \DateTime($reservation->end),   // reservation end
                    $reservation->id // reservation id
                );
        }
        $calendar_details =  $reservation_list;

        return response()->json($calendar_details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create a reservation in database
        reservations::create(request()->validate([
            'reservation_name' => ['required'],
            'start' => ['required'],
            'end' => ['required']
        ]) + ['user_id' => auth()->id()]);

        return response()->json(request()->input());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function show(reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function edit(reservations $reservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reservations $reservations)
    {
        reservations::where('id', $request->input('reservation'))->update([
            'canceld' => 1
        ]);
        return redirect('/home')->with('status', 'Reservation Canceled');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function destroy(reservations $reservations, Request $request)
    {
        reservations::where('id', $request->input('reservation'))->delete();

        return redirect('/home');
    }
}
