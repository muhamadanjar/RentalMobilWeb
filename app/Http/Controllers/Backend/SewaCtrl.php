<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transaksi\Sewa;
use Laracasts\Flash\Flash;
use App\Transaksi\RepositoryInterface as TransaksiInterface;
use App\Mobil\RepositoryInterface as MobilInterface;
class SewaCtrl extends BackendCtrl{
    public function __construct(Sewa $res,MobilInterface $mobil,TransaksiInterface $transaksi)
    {
        $this->reservation = $res;
        $this->mobil = $mobil;
        $this->transaksi = $transaksi;
    }

    public function index(){
        return view('backend.sewa.index');
    }

    public function create(){
        session(['aksi'=>'tambah']);
        return view('backend.sewa.form');
    }

    public function edit($id){
        session(['aksi'=>'edit']);
        $sewa = $this->reservation->findOrFail($id);
        return view('backend.sewa.form')->with('sewa',$sewa);
    }

    public function post(Request $request){
        try{
            $sewa = (session('aksi') == 'edit') ? $this->reservation->findOrFail($request->id) : new Sewa;
            $sewa->status = $request->status;
            $sewa->save();
            if($sewa->status == 'complete'){
                $this->mobil->updatestatusmobil($sewa->mobil_id);
            }
            Flash::success(trans('flash/transaksi.status_update'));
            return redirect()->route('backend.transaksi.index');
        }catch(Exception $e){
            Flash::error(trans('flash/transaksi.status_failed'));
            \DB::rollback();
            return redirect()->route('backend.transaksi.index');
        }
        
    }

    public function destroy($id){
        $this->reservation->findOrFail($id)->delete();
        Flash::success(trans('flash/transaksi.delete'));
        return redirect()->route('backend.dashboard');
    }

    
}
