<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Laracasts\Flash\Flash;
//use Yajra\Datatables\Datatables;
use App\Mobil\Mobil;
use App\Mobil\Merk;
use App\Mobil\Type;
use App\Officer\Officer;
use App\User;
use Hash;
class MobilCtrl extends BackendCtrl
{
    private $mobil;
    public function __construct(){
       
    }
    public function index(){
        $mobil = Mobil::get();
        return view('backend.mobil.index')->with('mobil',$mobil);
    }

    public function create(){
        if(Gate::check('create.mobil')){
            session(['aksi'=>'tambah']);
            return view('backend.mobil.tambah');
        }
        return redirect()->route('backend.index')->with('flash.error',trans('flash/mobil.create_not_allowed'));
    }

    public function edit($id){
        if(Gate::check('edit.mobil')){
            session(['aksi'=>'edit']);
            $mobil = Mobil::find($id);
            return view('backend.mobil.tambah')->with('mobil',$mobil);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');

    }

    public function update($request){
        Flash::success(trans('flash/mobil.updated'));
        $this->postMobil($request);
    }

    public function destroy($id){
        if(Gate::check('delete.mobil')){
            $mobil = Mobil::find($id)->delete();
            return redirect()->route('backend.mobil.index')->with('flash.success','Mobil Berhasil di Hapus..!!');
        }
        //Flash::success(trans('flash/case.created'));
        return redirect()->route('backend.index')->with('flash.error',trans('flash/mobil.delete_not_allowed'));
    }

    public function postMobil(Request $request){
        $user = auth()->user();
        $mobil = (session('aksi') == 'edit') ? Mobil::find($request->id) : new Mobil;
        $mobil->no_plat = $request->no_plat;
        $mobil->merk = $request->merk;
        $mobil->type = $request->type;
        $mobil->warna = $request->warna;
        $mobil->harga = $request->harga;
        $mobil->harga_perjam = $request->harga_perjam;   
        $mobil->author()->associate($user);
        $mobil->save();
        return redirect()->route('backend.mobil.index');
    }

    public function getData(){
        $mobil = Mobil::orderBy('id')->select(['id','no_plat', 'merk','type','warna',\DB::raw("CONCAT('Rp.',FORMAT(harga,2)) as harga")]);
        return Datatables::of($mobil)->make(true);
    }

    public function getFormDriver(){
        $merk = Merk::orderBy('merk','ASC')->get();
        $type= Type::orderBy('type','ASC')->get();
        
        return view('backend.mobil.formDriver')->with('merkselect',$merk)->with('typeselect',$type);
    }
    public function postFormDriver(Request $request){
        $driver = new User();
        $driver->name = $request->name;
        $driver->username = $request->username;
        $driver->email = $request->email;
        $driver->password = Hash::make($request->password);
        $driver->save();

        $driver->assignRole('driver');

        $officers = new Officer();
        $officers->name = $request->name;
        $officers->nip = ' ';
        $officers->alamat = $request->alamat;;
        $officers->no_telp = $request->no_telp;
        $officers->role = 'staff/karyawan';
        $officers->user_id = $driver->id;
        $officers->save();

        $mobil = new Mobil();
        $mobil->no_plat = $request->no_plat;
        $mobil->merk = $request->merk;
        $mobil->type = $request->type;
        $mobil->warna = $request->warna;
        $mobil->harga = $request->harga;
        $mobil->harga_perjam = $request->harga_perjam;   
        $mobil->author()->associate($driver);
        $mobil->save();
        Flash::success(trans('flash/mobil.drivercreated'));
        return redirect()->route('backend.dashboard.index');
        
    }
}
