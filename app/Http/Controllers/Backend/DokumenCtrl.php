<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Dokumen;
use Event;
class DokumenCtrl extends BackendCtrl
{
    public $secret = 'sikko_download';
    public $root_upload = '/files/uploads/dokumen/';
    private $_dokumen;
    public function __construct(Dokumen $dokumen){
        $this->middleware('auth');
        $this->_dokumen = $dokumen;
    }
    public function getIndex(){
        $dokumen = \App\Dokumen::get();
        session(['link_web'=>'file']);
        if (auth()->user()->isRole('admin') || auth()->user()->isRole('manager')) {
            $view = 'backend.dokumen.index';
        }else{
            $view = 'backend.dokumen.download';
        }
    	return view($view)->with('dokumen',$dokumen);
    }

    public function getTambah(){
    	if (Gate::check('create.dokumen')) {
            session(['aksi'=>'add']);
            $dokumen = new Dokumen();
            return view('backend.dokumen.tambah')->withDokumen($dokumen);
        }
        return redirect('/dokumen')->withInfo('Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function getEdit($id){
        if (Gate::check('edit.dokumen')) {
        	session(['aksi'=>'edit']);
            $dokumen = \App\Dokumen::find($id);
        	return view('backend.dokumen.tambah')->withDokumen($dokumen);
        }
        return redirect('/dokumen')->withInfo('Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postDokumen(Request $r){
        try {
            $dokumen = (session('aksi') == 'edit') ? \App\Dokumen::find($r->id) : new \App\Dokumen;
            $dokumen->judul_dokumen = $r->judul_dokumen;
            $dokumen->kategori = $r->kategori;
            $dokumen->tanggal = date('Y-m-d', strtotime($r->tanggal));
            if ($r->upload != null) {
                
                $fupload = $r->file('upload');
                $vdir_upload ='files/uploads/dokumen';
                $fileName=str_random(20) . '.' . $fupload->getClientOriginalExtension();
                $destinationPath = public_path().DIRECTORY_SEPARATOR.$vdir_upload;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                } else {
                }
                $fuploadName = $fupload->getClientOriginalName();
                $fupload->move($destinationPath, $fileName);
                $lokasi_file = $destinationPath.'/'.$fileName;
                $dokumen->upload = $fileName;
            }
            $dokumen->save();

            if(session('aksi') =='edit'){
                Event::fire('document.updated', [$dokumen, $dokumen]);
            }else{
                Event::fire('document.created', [$dokumen, $dokumen]);
            }
            return redirect()->route('backend.dokumen.index')->with('flash.success','Dokumen Berhasil ditambahkan');
        } catch (Exception $e) {
            
        }
    }

    public function postDelete($id){
        $vdir_upload ='/files/uploads/dokumen';
        if (Gate::check('edit.dokumen')) {
            $dokumen = \App\Dokumen::findOrFail($id);
            unlink(public_path().$vdir_upload.DIRECTORY_SEPARATOR.$dokumen->upload);
            $dokumen->delete();
            return redirect()->route('backend.dokumen.index');
        }
        return redirect()->route('backend.dokumen.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
    }

    public function postDownload($id){
        ignore_user_abort(true);
        set_time_limit(0); 
        $path = public_path($this->root_upload);
         
        //$secret = 'your-secret-string';
         
        if (isset($id) /*&& preg_match('/^([a-f0-9]{32})$/', $id)*/) {
            $dokumen = \App\Dokumen::find($id);    
            
            if (count($dokumen) == 1) {
                $obj = $dokumen;
                $fullPath = $path.$obj->upload;
                if ($fd = fopen ($fullPath, "r")) {


                    $fsize = filesize($fullPath);
                    $path_parts = pathinfo($fullPath);
                    $ext = strtolower($path_parts["extension"]);
                    switch ($ext) {
                        case "pdf":
                        header("Content-type: application/pdf");
                        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                        break;
                        // add more headers for other content types here
                        default;
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                        break;
                    }
                    header("Content-length: $fsize");
                    header("Cache-control: private"); //use this to open files directly
                    while(!feof($fd)) {
                        $buffer = fread($fd, 2048);
                        echo $buffer;
                    }
                    \DB::table('download')->update(['hits'=>DB::raw('hits+1')]);
                }else{
                    die("File tidak ditemukan");
                }
                fclose ($fd);
                exit;
            } else {
                die('no match');
            }
        } else {
            die('missing file ID');
        }
    }

    public function download($value=''){
        ignore_user_abort(true);
        set_time_limit(0); // disable the time limit for this script
         
        $path = "/absolute_path_to_your_files/"; // change the path to fit your websites document structure
         
        $dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
        $dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
        $fullPath = $path.$dl_file;
         
        if ($fd = fopen ($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                break;
                // add more headers for other content types here
                default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                break;
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose ($fd);
        exit;
    }
}
