<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class api extends Controller
{
    //
    public function index(){
        return view('js_integration');
        //  $admin=Auth::guard('admin')->logout();

        // echo'Welcome';
    }

}
