<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil\Mobil;
use App\Sewa;
use Carbon\Carbon;
class ApiCtrl extends Controller{
    public function getAllMobil(){
        $mobil = Mobil::orderBy('id')->where('status','tersedia')->get();
        return $mobil;
    }

    public function makeSewa(Request $request){
        
        $reservation = new Sewa();
        $reservation->status = $request->status;
        //$reservation->no_transaksi = $request->no_transaksi;
        $reservation->tgl_mulai = Carbon::now();
        $reservation->tgl_akhir = Carbon::now();
        $reservation->origin = $request->origin;
        $reservation->destination = $request->destination;
        $reservation->total_bayar = $request->total_bayar;
        $reservation->denda = 0;
        $reservation->customer_id = $request->customer_id;
        $reservation->mobil_id = $request->mobil_id;
        $reservation->save();

        return response()->json(['foo'=> $reservation]);
    }
}
