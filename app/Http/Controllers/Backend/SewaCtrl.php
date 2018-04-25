<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transaksi\Sewa;
use Laracasts\Flash\Flash;
use App\Transaksi\RepositoryInterface as TransaksiInterface;
use App\Mobil\RepositoryInterface as MobilInterface;
use LRedis;
use Mail;
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

    public function task(){
        return view('backend.sewa.task');
    }

    public function taskForm($id){
        session(['aksi'=>'edit']);
        $task = $this->reservation->findOrFail($id);
        $sewa_detail = \DB::table('sewa_detail')->where('sewa_id',$task->id)->first();
        
        $mobil = $this->mobil->mobilavailable();
        return view('backend.sewa.formTask')->with('sewaDetail',$sewa_detail)
        ->withTask($task)->withMobil($mobil);
    }

    public function postTask(Request $request){
        try{
            $sewa = (session('aksi') == 'edit') ? $this->reservation->findOrFail($request->id) : new Sewa;
            $sewa->status = $request->status;
            $sewa->mobil_id = $request->mobil;
            $sewa->total_bayar = $request->total_bayar;
            $sewa->save();
            if($sewa->status == 'complete'){
                //$this->mobil->updatestatusmobil($sewa->mobil_id);
                $this->mobil->updatestatus($sewa->mobil_id,'tersedia');
            }elseif($sewa->status == 'confirmed'){
                $this->mobil->updatestatus($sewa->mobil_id,'dipinjam');
                $data = array();
                $email = $sewa->customer->email;
                $name = $sewa->customer->name;
                $subject = 'Pesanan anda sudah terkonfirmasi.';
                $data['email'] = $sewa->customer->email;
                $data['name'] = $sewa->customer->name;
                $data['no_transaksi'] = $sewa->no_transaksi;
                $data['no_telp'] = $sewa->no_transaksi;
                Mail::send('email.orderconfirm', ['data' => $data],
                    function($mail) use ($email, $name, $subject){
                        $mail->from(getenv('MAIL_USERNAME'), "Trans Utama");
                        $mail->to($email, $name);
                        $mail->subject($subject);
                });
            }
            Flash::success(trans('flash/transaksi.status_update'));
            return redirect()->route('backend.transaksi.task.index');
        }catch(Exception $e){
            Flash::error(trans('flash/transaksi.status_failed'));
            \DB::rollback();
            return redirect()->route('backend.transaksi.task.index');
        }
        
    }
}
