<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomerCtrl extends Controller
{
    public function post(Request $request){
        $customers = new Customer();
        $customers->sex = $request->sex;
        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->no_telp = $request->email;
        $customers->religion = $request->religion;
        $customers->address = $request->address;
        $customers->save();
    }
}
