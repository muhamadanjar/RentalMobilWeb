<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CustomLogin;
class RegisterCtrl extends Controller{
    use CustomLogin;
    public function showRegistrationForm(){
        return view('register');
    }

    public function post(Request $request){
        $register = $this->register($request);
        return ($register);
        //return redirect()->route('home');
    }
}
