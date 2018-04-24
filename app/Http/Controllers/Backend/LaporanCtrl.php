<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transaksi\RepositoryInterface;
use Laracasts\Flash\Flash;
class LaporanCtrl extends BackendCtrl
{
    public function __construct(RepositoryInterface $transaksi){
        $this->transaksi = $transaksi;
    }

    public function index(){
        return view('backend.setting.laporan');
    }

    public function post(Request $request){
        $timeawal = strtotime($request->daritgl);
        $timeakhir = strtotime($request->sampaitgl);
        if($timeakhir < $timeawal){
            Flash::error('Akhir Tanggal Melebihi awal tanggal '.$timeawal.' || '.$timeakhir);
            return redirect()->route('backend.laporan.index');
        }
        $data = $this->transaksi->getDataRange(
            date('Y-m-d',$timeawal),
            date('Y-m-d',$timeakhir),
            $request->jenislaporan
        );
        return view('backend.setting.laporan')->with('data',$data);
    }
}
