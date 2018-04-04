<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class LaporanCtrl extends BackendCtrl
{
    public function __construct(){
        
    }

    public function index(){
        return view('backend.setting.laporan');
    }
}
