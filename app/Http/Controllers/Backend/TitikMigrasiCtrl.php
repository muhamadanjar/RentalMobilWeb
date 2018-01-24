<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transmigrasi\RepositoryInterface as TenagaKerjaRepository;
use Illuminate\Support\Facades\Gate;
use App\Transmigrasi\TitikTransmigrasi;
class TitikMigrasiCtrl extends BackendCtrl
{
    private $repo;
    function __construct(TenagaKerjaRepository $repo){
        $this->repo = $repo;
    }
    public function index(){
        
        $titik = TitikTransmigrasi::get();
        return view('backend.titiktransmigrasi.index')->with('titik',$titik);
    }

    public function create(){
        if (Gate::check('create.transmigrasi')){
            session(['aksi'=>'add']);
            return view('backend.titiktransmigrasi.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if (Gate::check('edit.transmigrasi')){
            $titik = TitikTransmigrasi::findOrFail($id);
            return view('backend.titiktransmigrasi.form')->with('titik',$titik);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if (Gate::check('delete.transmigrasi')){
            TitikTransmigrasi::findOrFail($id)->delete();
            return redirect()->route('backend.titiktransmigrasi.index')->with('flash.success','Data Berhasil di hapus!!.');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postTransmigrasi(Request $request){
        
        $query = (session('aksi') == 'edit' ? TitikTransmigrasi::findOrFail($request->id): new TitikTransmigrasi());
        $titik = $query;
        $titik->name = $request->name;
        $titik->x = $request->x;
        $titik->y = $request->y;
        $titik->x_decimal = $request->x_decimal;
        $titik->y_decimal = $request->y_decimal;
        $titik->save();
        
     
        if(session('aksi')=='edit'){
            $flashmsg = 'Data Berhasil Di Ubah';
        }else{
            $flashmsg = 'Data Berhasil ditambahkan!!.';
        }
        return redirect()->route('backend.titiktransmigrasi.index')->with('flash.success',$flashmsg);
    }
}
