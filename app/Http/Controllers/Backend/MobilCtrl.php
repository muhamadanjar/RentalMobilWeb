<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mobil\Mobil;
class MobilCtrl extends BackendCtrl
{
    private $layer;
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
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
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
        $this->postMobil($request);
    }

    public function destroy($id){
        if(Gate::check('delete.layer')){
            $layer = $this->layer->delete($id);
            return redirect()->route('backend.mobil.index')->with('flash.success','Layer Berhasil di Hapus..!!');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postMobil(Request $request){
        $user = auth()->user();
        $mobil = (session('aksi') == 'edit') ? Mobil::find($request->id) : new Mobil;
        $mobil->no_plat = $request->no_plat;
        $mobil->merk = $request->merk;
        $mobil->type = $request->type;
        $mobil->warna = $request->warna;
        $mobil->harga = $request->harga;
        $mobil->author()->associate($user);
        $mobil->save();
        return redirect()->route('backend.mobil.index');
    }
}
