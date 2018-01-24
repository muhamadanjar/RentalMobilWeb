<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Map\RepositoryInterface as LayerRepository;
use Illuminate\Support\Facades\Gate;
class LayerCtrl extends BackendCtrl{

    private $layer;
    public function __construct(LayerRepository $lr){
        $this->layer = $lr;
    }
    public function index(){
        $layer = $this->layer->getlayergoogle();
        
        return view('backend.layer.index')->with('layer',$layer);
    }

    public function create(){
        if(Gate::check('create.layer')){
            session(['aksi'=>'tambah']);
            $group = $this->layer->getgroupsgoogle();
            return view('backend.layer.tambah')->with('groups',$group);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if(Gate::check('edit.layer')){
            session(['aksi'=>'edit']);
            $layer = $this->layer->find($id);
            $group = $this->layer->getgroupsgoogle();
            return view('backend.layer.tambah')->with('layer',$layer)->with('groups',$group);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');

    }

    public function postLayer(Request $request){
        $layer = $this->layer->postLayer($request,session('aksi'),$request->id);
        return redirect()->route('backend.layer.index');
    }

    public function store($request)
    {
        $this->postLayer($request);
    }

    public function update($request){
        $this->postLayer($request);
    }

    public function destroy($id){
        if(Gate::check('delete.layer')){
            $layer = $this->layer->delete($id);
            return redirect()->route('backend.layer.index')->with('flash.success','Layer Berhasil di Hapus..!!');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }


}
