<?php

namespace App\Http\Controllers;

use App\Models\Delivery;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countDeliveries = count(Delivery::all());
        return view('pages.dashboard', [
            'countDeliveries' => $countDeliveries
        ]);
    }
}
