<?php

namespace App\Http\Controllers\Backend;
use App\FileManager\FileManager;
use Illuminate\Http\Request;
use Gate;
class FileCtrl extends BackendCtrl{
    private $fileManager;
    
        function __construct(FileManager $fileManager)
        {
            $this->fileManager = $fileManager;
        }
    
        public function index(Request $request){
            if(Gate::check('access.file')){
                $path = $request->get('path', '');
                $paths = $this->buildBreadcrumbs($path);
                $items = $this->fileManager->all($path);
                
                return view('backend.files.index', compact('items', 'paths', 'path'));
            }
            return redirect()->route('backend.index')->with('flash.error','Anda Tidak diijinkan Mengakses Halaman ini');
        }
    
        public function store(Request $request){
            
            if($request->hasFile('file') && $request->file('file')->isValid()){
                $file = $request->file('file');
                $destination = $this->fileManager->filePath($request->get('path'));
                $file->move($destination, $file->getClientOriginalName());
    
                return redirect()->back()->with('flash.success', 'Upload file berhasil');
            }
    
            return redirect()->back()->with('flash.error', 'Upload file gagal');
        }
    
        public function show($id)
        {
        }
    
        public function destroy($id)
        {
            $this->fileManager->delete($id);
            return redirect()->back()->with('flash.success', 'File berhasil dihapus');
        }
    
        protected function buildBreadcrumbs($path)
        {
            $paths = explode('/', $path);
    
            if(!$path)
            {
                unset($paths[0]);
            }
    
            $breadcrumbs = [
                route('backend.files.index', ['path' => ''])  => 'Home'
            ];
    
            $stack = '';
            foreach($paths as $segment)
            {
                $stack .= $segment . '/';
                $breadcrumbs[route('backend.files.index', ['path' => $stack])] = $segment;
            }
    
            return $breadcrumbs;
        }
}
