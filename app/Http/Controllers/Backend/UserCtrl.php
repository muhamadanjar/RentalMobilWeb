<?php

namespace App\Http\Controllers\Backend;
 
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Moderator\RepositoryInterface;
use App\Post\RepositoryInterface as PostRepository;
use Validator;
use Gate;

class UserCtrl extends BackendCtrl{
    private $repo;
    public function __construct(RepositoryInterface $repo,PostRepository $repoPost){
        $this->middleware('auth');
        $this->repo = $repo;
        $this->repoPost = $repoPost;
    }
    
    public function getIndex(){
        if (!Gate::check('create.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        session(['route_link' => 'normal']);
        
        $user = User::get();
        return view('backend.moderator.users.index')
            ->withUsers($user);
    }

    public function getTambah(){
        if (!Gate::check('create.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $role = $this->getRole();
        $status = 'add';
        $users = new User();
        session(['aksi'=>$status]);
        return view('backend.moderator.users.create')
        ->withRole($role)
        ->withUsers($users)
        ->withStatus($status);
    }

    public function postAddEdit(Request $request){
        if (!Gate::check('create.user')) {
            return redirect()->route('backend.index')->with('flash.info','Anda tidak diijinkan mengakses halaman :(');
        }
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:10',
                'password' => 'required',
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('backend.pengaturan.users')
                        ->withErrors($validator)
                        ->withInput();
            }

            if($request->exists('image')){
                $fileName = str_random(20) . '.' . $request->file('image')->getClientOriginalExtension();
            }
                
            $status = 0;
            $aksi = (session('aksi') == 'edit') ? 1 : 0;
            if ($aksi) {
                $user = User::find($request->id);
                /*if($request->exists('image')){
                    if(isset($user->image)){
                        $check_image = file_exists(public_path().'/images/users/'.$user->image);
                        if($check_image) unlink(public_path().'/images/users/'.$user->image);
                    }
                    $this->repo->UploadImage($request->file('image'),'images/users',$fileName);
                    $user->image = $fileName;
                }*/
            }else{
                $user = new User();
                /*if($request->exists('image')){
                    $this->repo->UploadImage($request->file('image'),'images/users',$fileName);
                    $user->image = $fileName;
                }*/
            //$user->level = $request->level;
            }
            $user->foto = $request->foto;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->oldpassword == $request->password){
                $user->password = $request->oldpassword;        
            }else{
                $user->password = bcrypt($request->password);           
            }
            $user->save();
            if(!$user->isRole('admin')){
                $user->roles()->sync(array_get($request, 'groups', []));
            }
            
            
            return redirect()->route('backend.pengaturan.users');
        }else{
            return redirect()->route('backend.pengaturan.users');
        }
    }

    public function getUbah($id){
        if (!Gate::check('create.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $role = $this->getRole();
        $user = User::findOrFail($id);
        $status = 'edit';
        session(['aksi'=>$status]);
        return view('backend.moderator.users.create')->withStatus('edit')
        ->withRole($role)
        ->withUsers($user);
    }

    public function postHapus($id){
        if (! $this->authorize('delete.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.pengaturan.users')->with('flash.success','User berhasil di hapus.');
    }

    public function getAktifnonaktif($id){
        if (!Gate::check('edit.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $users = User::find($id);
        $users->isactived = ($users->isactived == 0) ? 1:0;
        $users->save();
        $notif = 'Anda Berhasil Menonaktifkan User';
        if($users->isactived){
            $notif = 'Anda Berhasil Mengaktifkan User';
        }
        return redirect()->route('backend.pengaturan.users')->with('flash.success',$notif);
    }

    public function getLevel($layerid=''){
        $levelform = \Input::get('level');
        $array = array();
        $array2 = array();
        if(empty($layerid)){
            return 'layerid kosong';
        }
        foreach ($levelform as $key => $value) {
            $array['layer_id'] = $layerid;
            $array['role_id'] = $value;
            array_push($array2,$array); 
        }
        return $array2;
    }

    public function getGantiPassword(){
        if (!Gate::check('edit.user')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $user = User::find(auth()->user()->id);
        return view('master.gantipassword')->withUsers($user);
    }

    public function postGantiPassword(Request $request){
        if (!Gate::check('create.edit')) {
            return redirect()->route('backend.dashboard.index')->with('flash.error','Anda dilarang mengakses Halaman ini.');
        }
        $user = User::find(auth()->user()->id);
        if($request->oldpassword == $request->password){
            $user->password = $request->oldpassword;        
        }else{
            $user->password = bcrypt($request->password);           
        }
        $user->save();

        return redirect('home');
    }

    public function resetPassword($id){
        $user = $this->repo->findUserById($id);
        $password = $this->repo->resetPassword($user);

        return json_encode(['status' => 1, 'password' => $password]);
    }

    public function getHistoryLog(){
        $history = Activity::orderBy('user_id','DESC')->where('user_id',auth()->user()->id)->get();
        return view('master.activity_log')->with('history',$history);
    }

    public function notifyJedi($id){
        // this is where the notification logic will be implemented
        $jedi = User::findOrFail($id);
        $jedi->notify(new UsulanAdd($jedi));
         
        if($jedi->is_lightsaber_on){
            return redirect()->route('home')
                ->with('message', 'We have notified '.$jedi->name.' that their lightsaber is currently turned ON')
                ->with('status', 'info');
        }else{
            return redirect()->route('home')
                ->with('message', 'We have notified '.$jedi->name.' that their lightsaber is currently turned OFF')
                ->with('status', 'info');
        }
    }

    public function getRole(){
        return Role::where('name','<>','admin')->get();
    }

    public function GetDftrLevel($lvl='') {
    
        $level = Role::whereRaw('id != ?',array(0))->get();
        $a = '';
        foreach ($level as $key => $value) {
            $ck = (strpos($lvl, ".$value->id") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='level[]' class='styled' value='$value->id' $ck> $value->id - $value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function changePhoto(){
        return $this->repoPost->postfeatureimage('/images/uploads/users/');
    }

    public function removePhoto($id){
        $users = User::findOrfail($id);
        session(['remove_photo'=>$users->foto]);

        
    }
}
