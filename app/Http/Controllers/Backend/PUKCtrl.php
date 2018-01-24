<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transmigrasi\PUK;
use App\Transmigrasi\PYB;
use App\Transmigrasi\RepositoryInterface as TenagaKerjaRepository;
use Illuminate\Support\Facades\Gate;
class PUKCtrl extends BackendCtrl
{
    private $repo;
    function __construct(TenagaKerjaRepository $repo){
        $this->repo = $repo;
    }
    public function index(){
        
        $puk = $this->repo->PukGet();
        
        return view('backend.tenagakerja.puk.index')->with('puk',$puk);
    }

    public function create(){
        if (Gate::check('create.tenagakerja')){
            session(['aksi'=>'add']);
            return view('backend.tenagakerja.puk.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if (Gate::check('edit.tenagakerja')){
            session(['aksi'=>'edit']);
            $puk = $this->repo->PukFind($id);
            
            return view('backend.tenagakerja.puk.form')->with('puk',$puk);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if (Gate::check('delete.tenagakerja')){
            $puk = $this->repo->deletePUK($id);
            return redirect()->route('backend.tenagakerja.puk.index')->with('flash.success','Data Berhasil di hapus!!.');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postTenagaKerja(Request $request){
        
        $this->repo->postPUK(session('aksi'),$request);
        if(session('aksi')=='edit'){
            $flashmsg = 'Data Berhasil Di Ubah';
        }else{
            $flashmsg = 'Data Berhasil ditambahkan!!.';
        }
        return redirect()->route('backend.tenagakerja.puk.index')->with('flash.success',$flashmsg);
    }
}
