<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil\Mobil;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getPilihSewa(){
        return view('pilihsewa');
    }

    public function getRentalMobil(){
        $mobil = Mobil::orderBy('id')->where('status','tersedia')->get();
	    return view('welcome')->with('mobil',$mobil);
    }

    public function getTaxiMobil(){
        $mobil = Mobil::orderBy('id')->where('status','tersedia')->get();
	    return view('welcome')->with('mobil',$mobil);
    }
}
