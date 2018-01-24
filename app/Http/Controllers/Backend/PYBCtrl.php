<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transmigrasi\PUK;
use App\Transmigrasi\PYB;
use App\Transmigrasi\RepositoryInterface as TenagaKerjaRepository;
use Illuminate\Support\Facades\Gate;
class PYBCtrl extends BackendCtrl
{
    private $repo;
    function __construct(TenagaKerjaRepository $repo){
        $this->repo = $repo;
    }
    public function index(){

        $puk = PUK::get();
        $pyb = $this->repo->PybGet();
        
        return view('backend.tenagakerja.pyb.index')->with('pyb',$pyb);
    }

    public function create(){
        if (Gate::check('create.tenagakerja')){
            session(['aksi'=>'add']);
            return view('backend.tenagakerja.pyb.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if (Gate::check('edit.tenagakerja')){
            session(['aksi'=>'edit']);
            $pyb = $this->repo->PybFind($id);
            
            return view('backend.tenagakerja.pyb.form')->with('pyb',$pyb);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if (Gate::check('delete.tenagakerja')){
            $pyb = $this->repo->deletePYB($id);

            return redirect()->route('backend.tenagakerja.index')->with('flash.success','Data Berhasil di hapus!!.');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postTenagaKerja(Request $request){
        
        $this->repo->postPYB(session('aksi'),$request);
        if(session('aksi')=='edit'){
            $flashmsg = 'Data Berhasil Di Ubah';
        }else{
            $flashmsg = 'Data Berhasil ditambahkan!!.';
        }
        return redirect()->route('backend.tenagakerja.index')->with('flash.success',$flashmsg);
    }
}
