<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\Agenda\RepositoryInterface;
use App\Post\RepositoryInterface as postRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Gate;
use App\Agenda\Agenda;
use Laracasts\Flash\Flash;
class AgendaCtrl extends BackendCtrl
{
    /**
     * @type RepositoryInterface
     */
    private $repo;
    private $postRepo;

    public function __construct(RepositoryInterface $repo,postRepository $postRepo)
    {
        $this->repo = $repo;
        $this->postRepo = $postRepo;
    }

    public function getIndex(){
        session(['aksi'=> null]);
        session(['link_web'=>'agenda']);
        return view('backend.agenda.index');
    }

    public function getData(){
        $agenda = DB::table('agenda')->select(['id','judul_agenda', 'tempat', DB::raw("CONCAT(start_at,' - ',end_at) as waktu")]);
        return Datatables::of($agenda)->make(true);
    }

    public function getTambah(){
        if (!Gate::check('create.agenda')) {
            return redirect()->route('backend.index')->with('flash.info','Anda tidak diijinkan mengakses halaman :(');
        }
        session(['aksi'=>'add']);
        $kategori = new Agenda();
        $_arr = array();
        foreach($kategori->getKategori() as $key){
            array_push($_arr,$key);
        }
        
        return view('backend.agenda.form')->withKategoris($kategori);
    }

    public function getEdit($id){
        if (!Gate::check('edit.agenda')) {
            return redirect()->route('backend.index')->with('flash.info','Anda tidak diijinkan mengakses halaman :(');
        }
        session(['aksi'=>'edit']);
        $agenda = Agenda::find($id);
        $kategori = new Agenda();
        return view('backend.agenda.form')->withAgenda($agenda)->withKategoris($kategori);
    }

    public function postAgenda(Request $request){
        if (!Gate::check('create.agenda')) {
            return redirect()->route('backend.index')->with('flash.info','Anda tidak diijinkan mengakses halaman :(');
        }
        \DB::beginTransaction();
        try{
            /*$query = (session('aksi') == 'edit') ? Agenda::find($request->id) : new Agenda;
            $agenda = $query;
            $agenda->judul_agenda = $request->judul_agenda;
            $agenda->isi_agenda = $request->isi_agenda;
            $agenda->tempat = $request->tempat;
            $agenda->start_at = $request->start_at;
            $agenda->end_at = $request->end_at;
            $agenda->kategori = $request->kategori;
            $agenda->author_id = auth()->user()->id;
            $agenda->image = $request->image;
            $agenda->save();*/

            $this->repo->createEditAgenda($request,session('aksi'));
            
            DB::commit();
            echo "Agenda Saved";
            if(session('aksi') == 'edit'){
                Flash::success(trans('flash/agenda.updated'));
            }else{
                Flash::success(trans('flash/agenda.created'));
            }
            session(['aksi'=> null]);
        } catch(Exception $e){
            \DB::rollback();
        }
        return redirect()->route('backend.agenda.index');
        
    }

    public function postDelete($id){
        if (!Gate::check('delete.agenda')) {
            return redirect()->route('backend.index')->with('flash.info','Anda tidak diijinkan mengakses halaman :(');
        }
        $agenda = Agenda::find($id);
        if($agenda != null){
            $agenda->delete();
            Event::fire('agenda.deleted', [$agenda, $agenda]);

            Flash::warning(trans('flash/agenda.deleted'));
        }
        return redirect()->route('backend.agenda.index');
    }

    public function postImage(){
        return $this->postRepo->postfeatureimage('/images/uploads/agenda/');
    }
}
