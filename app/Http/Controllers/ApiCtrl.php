<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mobil\Mobil;
use App\Transaksi\Sewa;
use App\User;
use Carbon\Carbon;
use Datatables;
use DB;
use App\Mobil\RepositoryInterface as MobilInterface;
use App\Transaksi\RepositoryInterface as TransaksiInterface;

class ApiCtrl extends Controller{
    public function __construct(MobilInterface $mobil,TransaksiInterface $transaksi){
        $this->mobil = $mobil;
        $this->transaksi = $transaksi;
    }
    public function getAllMobil(){
        $mobil = $this->mobil->mobilavailable();
        return response($mobil,200);
    }
    public function getDriverInfo($id){
        $driver = $this->mobil->getDriverInfo($id);
        return $driver;
    }
    public function updateStatusMobil($id){
        $mobil = $this->mobil->updatestatusmobil($id);
        return response()->json(['status'=>$mobil]);
    }
    public function getTotalMobil(){
        $mobil = $this->mobil->countmobil();
        return response($mobil,200);
    }
    public function getReservation(Request $request) {
        $sewa = $this->transaksi->getDatatableData();
        return Datatables::of($sewa)
        ->editColumn('tgl_mulai', function ($user) {
            return $user->tgl_mulai;
        })
        ->editColumn('created_at', '{!! $created_at !!}')
        ->editColumn('updated_at', function ($user) {
            return $user->updated_at->format('Y/m/d');
        })
       
        ->editColumn('status', '{{$status}}')
        ->filter(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('sewa.status', 'like', "%{$request->get('status')}%");
            }
            if ($request->has('tgl_mulai')) {
                $query->whereRaw("DATE_FORMAT(sewa.tgl_mulai,'%H:%i:%s') like ?", ["%{$request->get('tgl_mulai')}%"]);
            }

            if ($request->has('sq')) {
                $query->whereRaw("DATE_FORMAT(sewa.tgl_mulai,'%H:%i:%s') like ?", ["%{$request->get('sq')}%"])
                    ->orWhere('sewa.origin', 'like', "%{$request->get('sq')}%")
                    ->orWhere('sewa.destination', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.no_plat', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.warna', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.merk', 'like', "%{$request->get('sq')}%");
            }
            
        })
        ->make(true);
    }
    public function makeSewa(Request $request){
        $reservation = $this->transaksi->makeSewa($request);

        return $reservation;
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

    public function checkstatusmobil($id){
        $mobil = $this->mobil->checkstatus($id);
        return response($mobil,200);
    }

    public function checkstatuspesanan($id){
        $sewa = $this->transaksi->checkstatus($id);
        return response()->json($sewa);
    }

    public function cancelledPesanan($id){
        return $this->transaksi->setStatusPesanan($id,'cancelled');
    }


}
