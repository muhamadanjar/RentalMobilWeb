<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Faq;
use DB;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Gate;
class FaqCtrl extends BackendCtrl{
    public function index(){
        $faq = Faq::orderBy('id')->get();
        return view('backend.faq.index')->with('faq',$faq);
    }

    public function create(){
        if(Gate::check('create.faq')){
            session(['aksi'=>'add']);
            return view('backend.faq.form');
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function edit($id){
        if(Gate::check('edit.faq')){
            session(['aksi'=>'edit']);
            $faq = Faq::findOrFail($id);
            return view('backend.faq.form')->with('faq',$faq);
        }
        return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function store(Request $request){
        return $this->postFaq($request);
    }

    public function update(Request $request){
        return $this->postFaq($request);
    }

    public function postFaq($request){
        \DB::beginTransaction();
        try{
            $query = (session('aksi') == 'edit') ? Faq::find($request->id) : new Faq;
            $faq = $query;
            $faq->pertanyaan = $request->pertanyaan;
            $faq->jawaban = $request->jawaban;
            $faq->save();
            
            DB::commit();
            echo "faq Saved";
            if(session('aksi') == 'edit'){
                Flash::success(trans('flash/agenda.updated'));
            }else{
                Flash::success(trans('flash/agenda.created'));
            }
            
            session(['aksi'=> null]);
        } catch(Exception $e){
            \DB::rollback();
        }

        return redirect()->route('backend.faq.index');
    }

    public function destroy($id){
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return redirect()->route('backend.faq.index');
    }
}
