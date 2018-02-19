<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil\Mobil;
class ApiCtrl extends Controller{
    public function getAllMobil(){
        $mobil = Mobil::orderBy('id')->get();
        return $mobil;
    }
}
