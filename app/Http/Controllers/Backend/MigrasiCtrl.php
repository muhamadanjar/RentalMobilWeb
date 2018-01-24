<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transmigrasi\Transmigrasi;
use App\Transmigrasi\RepositoryInterface;
use App\Provinsi;
use App\Kabupaten;
use Validator;
use Illuminate\Support\Facades\Gate;
class MigrasiCtrl extends BackendCtrl
{
    public function __construct(RepositoryInterface $repo){
        $this->repo = $repo;
    }
    public function index(){
        $transmigrasi = Transmigrasi::get();
        return view('backend.transmigrasi.index')->with('transmigrasi',$transmigrasi);
    }

    public function create(){
        if (Gate::check('create.transmigrasi')) {
            session(['aksi'=>'add']);
            $asal = Provinsi::orderBy('kode_prov')->get();
            $tujuan = Kabupaten::orderBy('kode_kab')->get();
            return view('backend.transmigrasi.form')->with('asal',$asal)->with('tujuan',$tujuan);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
        
    }

    public function edit($id){
        if (Gate::check('edit.transmigrasi')){
            session(['aksi'=>'edit']);
            $transmigrasi = Transmigrasi::findOrFail($id);
            $asal = Provinsi::orderBy('kode_prov')->get();
            $tujuan = Kabupaten::orderBy('kode_kab')->get();
            return view('backend.transmigrasi.form')->with('transmigrasi',$transmigrasi)->with('asal',$asal)->with('tujuan',$tujuan);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if (Gate::check('delete.transmigrasi')){
            $transmigrasi = $this->repo->deleteTransmigrasi($id);
            return redirect()->route('backend.transmigrasi.index')->with('flash.success','Data Berhasil di hapus!!.');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');

    }

    public function postMigrasi(Request $request){
        $validator = Validator::make($request->all(), [
            'wilayah_asal' => 'required',
            'wilayah_tujuan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->route('backend.transmigrasi.index')->with('flash.error','Data gagal di input!.');
        }else{
            $this->repo->postTransmigrasi(session('aksi'),$request);
            if(session('aksi')=='edit'){
                $flashmsg = 'Data Berhasil Di Ubah';
            }else{
                $flashmsg = 'Data Berhasil ditambahkan!!.';
            }
            return redirect()->route('backend.transmigrasi.index')->with('flash.success',$flashmsg);
        }
        
    }
}
