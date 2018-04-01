<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mobil\Mobil;
use App\Sewa;
use App\User;
use Carbon\Carbon;
use Datatables;
use DB;

class ApiCtrl extends Controller{
    
    public function getAllMobil(){
        $mobil = Mobil::orderBy('id')->where('status','tersedia')->get();
        return response($mobil,200);
    }
    public function getTotalMobil(){
        $mobil = Mobil::count();
        return response($mobil,200);
    }
    public function getReservation(Request $request) {
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'id',
                'customer_id',
                'mobil_id',
                'tgl_mulai',
                'tgl_akhir',
                'origin',
                'destination',
                'total_bayar',
                'status',
                'created_at',
                'updated_at']);
        
        
        return Datatables::of($sewa)
        ->editColumn('status', '{{$status}}')
        ->filter(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('status', 'like', "%{$request->get('status')}%");
            }
        })
        ->make(true);
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
    public function getDataPemesananBulanan(){
        $pemesananbulan_query = DB::table('sewa')
            ->select(
                DB::raw('MONTH(sewa.tgl_mulai) as bulan'),
                DB::raw('YEAR(sewa.tgl_mulai) as tahun'),
                DB::raw('COUNT(sewa.tgl_mulai) as total_bulan')
            )->groupBy('bulan')
            ->groupBy('tahun')
            ->orderBy('tahun')->get();

        return $pemesananbulan_query;
    }


}
