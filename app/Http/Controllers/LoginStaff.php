<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginStaff extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function show(){
        return view('login');
    }

    public function process(Request $request){
        $this->validate($request,[
            'staff_id'=> 'required',
            'password'=> 'required'
        ]);
        if(!auth()->attempt($request->only('staff_id','password'),$request->remember_me)){
                return back()->with('status','Invalid login credentials');
        }
            return redirect()->route('dashboard');
    }
}
