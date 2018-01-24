<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\AuditTrail\Activity\RepositoryInterface;
use Illuminate\Support\Facades\Gate;
class LogCtrl extends BackendCtrl
{
    /**
     * @var
     */
    private $repo;
    
    function __construct(RepositoryInterface $repo){
        $this->repo = $repo;
        parent::__construct();
    }
    
        public function index(Request $request){
            if (Gate::check('access.backend')) {
                $logs = $this->repo->paginate($request->get('q'));
                //dd($logs);
                return view('backend.log.index', compact('logs'));
            }
            return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
        }
    
        public function show($id)
        {
            if (Gate::check('access.backend')) {
                $log = $this->repo->find($id);
                $revisions = $log->revisions;
                return view('backend.log.show', compact('log', 'revisions'));
            }
            return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
        }
}
