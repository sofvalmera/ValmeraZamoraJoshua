<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(){


    }
    public function register(){
        return view('front.account.register');


    }
    public function processDioskoLordtaasapamani(Request $request){

        $validator =Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);
        if($validator->passes()){
            $brand=new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->save();


            $request->session()->flash('success','You have been Registered Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Brand Added Successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
}
