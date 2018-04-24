<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Transaksi\Promo;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Post\RepositoryInterface;
class PromoCtrl extends BackendCtrl
{
    public function __construct(RepositoryInterface $postRepo){
        $this->repoPost = $postRepo;
    }
    public function index(){
        $promo = Promo::orderBy('tgl_mulai','DESC')->get();
        return view('backend.promo.index')->with('promo',$promo);
    }

    public function create(){
        session(['aksi'=>'add']);
        $promo = new Promo();
        $path = $promo->getPath();
        $permanentlink = $promo->getPermalink();
        return view('backend.promo.form')->withPromo($promo)
        ->withPath($path)->with('permanentlink',$permanentlink);
    }
    public function edit($id){
        session(['aksi'=>'edit']);
        $promo = Promo::find($id);
        $path = $promo->getPath();
        $permanentlink = $promo->getPermalink();
        return view('backend.promo.form')->withPromo($promo)
        ->withPath($path)->with('permanentlink',$permanentlink);
    }
    
    public function destroy($id){
        Promo::findOrFail($id)->delete();
        return redirect()->route('backend.promo.index');
    }

    public function post(Request $request){
        try{
            $promo = (session('aksi') == 'edit') ? Promo::findOrFail($request->id) : new Promo();
            $promo->kode_promo = $request->kode_promo;
            $promo->name = $request->promo;
            $promo->tgl_mulai = date('Y-m-d',strtotime($request->tgl_mulai));
            $promo->tgl_akhir = date('Y-m-d',strtotime($request->tgl_akhir));
            $promo->foto = $request->foto;
            $promo->description = $request->description;
            $promo->save();
        }catch(Exception $e){
            \DB::rollback();
            return redirect()->route('backend.promo.index')->with('flash.error',$e);
        }
        return redirect()->route('backend.promo.index');
    }

    public function uploadPhoto(){
        $dir = public_path().'/images/uploads/promo/';
        if(!is_dir($dir))
            mkdir($dir);
            $ext = pathinfo($_FILES["images"]["name"],PATHINFO_EXTENSION);
            $filename = time().'_'.urlencode(pathinfo($_FILES["images"]["name"],PATHINFO_FILENAME)).'.'.$ext;
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $dir. $filename)){
                return json_encode(array(
                    'error'=>false,
                    'dir'=>$dir,
                    'filename'=>$filename,
                    'data'=>$_FILES["images"]
                ));
                exit;
            }
        return json_encode(array('error'=>true,'message'=>'Upload process error'));
        exit;
    }
    
}
