<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Post\Category;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
class CategoryCtrl extends BackendCtrl{
    public function index(){
        session(['link_web'=>'page']);
        $kategori = Category::get();
        return view('backend.kategori.index')->withKategori($kategori);
    }

    public function create(){
        
        if(Gate::check('create.article')){
            session(['aksi'=>'add']);
            return view('backend.kategori.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if(Gate::check('edit.article')){
            session(['aksi'=>'edit']);
            $kategori = Category::findOrFail($id);
            return view('backend.kategori.form')->withKategori($kategori);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if(Gate::check('delete.article')){
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('backend.kategori.index');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postCategory(Request $r){
        try {
            $q = (session('aksi') == 'edit') ? Category::findOrFail($r->id) : new Category();
            $kategori = $q;
            $kategori->name = $r->name;
            $kategori->slug = str_slug($r->name);
            $kategori->save();
            return redirect()->route('backend.kategori.index');
        }catch(Exception $e){
            return redirect()->route('backend.kategori.index');
        }
        
    }
}
