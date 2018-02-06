<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mobil\Fasilitas;
class FasilitasCtrl extends BackendCtrl{
    public function index(){
        $fasilitas = Fasilitas::get();
        return view('backend.fasilitas.index')->with('fasilitas',$fasilitas);
    }

    public function create(){
        if(Gate::check('create.fasilitas')){
            session(['aksi'=>'tambah']);
            
            return view('backend.fasilitas.tambah');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if(Gate::check('edit.fasilitas')){
            session(['aksi'=>'edit']);
            $fasilitas = Fasilitas::find($id);
            return view('backend.fasilitas.tambah')->with('fasilitas',$fasilitas);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');

    }


    public function update($request){
        $this->postFasilitas($request);
    }

    public function destroy($id){
        if(Gate::check('delete.fasilitas')){
            $fasilitas = Fasilitas::findOrFails($id)->delete($id);
            return redirect()->route('backend.fasilitas.index')->with('flash.success','Mobil Berhasil di Hapus..!!');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postFasilitas(Request $request){
        $user = auth()->user();
        $mobil = (session('aksi') == 'edit') ? Fasilitas::find($request->id) : new Fasilitas;
        $mobil->name = $request->name;
        $mobil->slug = $request->slug;
        $mobil->save();
        return redirect()->route('backend.fasilitas.index');
    }
}
