<?php

namespace App\Http\Controllers;

use App\reservations;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        if(auth()->user()->where('id', 1)) {
            $reservations = reservations::all();
            $user = User::where('id', 1)->first();
            
            return view('admin.index', compact('reservations', 'user'));
        }
    }
}
