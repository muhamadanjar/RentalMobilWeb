<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Permission;

class PermissionCtrl extends BackendCtrl{
    public function index(){
        $permissions = Permission::get();
        return view('backend.permissions.index')->with('permissions',$permissions);
    }
}
