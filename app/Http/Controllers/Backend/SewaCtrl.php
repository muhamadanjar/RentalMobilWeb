<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Sewa;
class SewaCtrl extends BackendCtrl
{
    public function __construct(Sewa $res)
    {
        $this->reservation = $res;
    }

    public function index(){
        return view('backend.sewa.index');
    }

    public function create(){
        session(['aksi'=>'tambah']);
        return view('backend.sewa.form');
    }

    public function edit($id){
        session(['aksi'=>'edit']);
        $sewa = $this->reservation->findOrFail($id);
        return view('backend.sewa.form')->with('sewa',$sewa);
    }

    public function post(Request $request){
        $sewa = (session('aksi') == 'edit') ? $this->reservation->findOrFail($request->id) : new Sewa;
        $sewa->status = $request->status;
        $sewa->save();
        
        return redirect()->route('backend.mobil.index');
    }

    public function destroy($id){
        $this->reservation->findOrFail($id)->delete();
        return redirect()->route('backend.dashboard');
    }

    
}
