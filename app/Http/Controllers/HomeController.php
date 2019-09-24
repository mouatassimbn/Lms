<?php

namespace App\Http\Controllers;

use App\reservations;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        date_default_timezone_set('America/Moncton');
        $date = date('m/d/Y h:i:s a', time());
        $reservations = auth()->user()->reservations->where('canceld', 0);

        if (auth()->user()->id == 1) {
            return redirect('/dashboard');
        }

        return view('home.index', compact('reservations'));
    }
}
