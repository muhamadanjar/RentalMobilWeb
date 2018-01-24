<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Post\Tag;
use Illuminate\Support\Facades\Gate;
class TagCtrl extends BackendCtrl
{
    public function index(){
        
        session(['link_web'=>'page']);
        $tags = Tag::get();
        return view('backend.tags.index')->withTags($tags);
        
    }

    public function create(){
        if(Gate::check('create.article')){
            session(['aksi'=>'add']);
            return view('backend.tags.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if(Gate::check('edit.article')){
            session(['aksi'=>'edit']);
            $tags = Tag::findOrFail($id);
            return view('backend.tags.form')->withTags($tags);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function destroy($id){
        if(Gate::check('delete.article')){
            $tags = Tag::findOrFail($id);
            $tags->delete();
            return redirect()->route('backend.tags.index')->with('flash.success','Tag Berhasil dihapus');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postTag(){
        try {
            $q = (session('aksi') == 'edit') ? Tag::findOrFail($r->id) : new Tag();
            $kategori = $q;
            $kategori->name = $r->name;
            $kategori->slug = str_slug($r->name);
            $kategori->save();
            return redirect()->route('backend.tags.index')->with('flash.success','Tag Berhasil ditambahkan');
        }catch(Exception $e){
            return redirect()->route('backend.tags.index')->with('flash.error','Tag Berhasil ditambahkan');;
        }
    }
}
