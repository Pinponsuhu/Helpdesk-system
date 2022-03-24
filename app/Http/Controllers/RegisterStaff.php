<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterStaff extends Controller
{
    public function show(){
        return view('register');
    }
    public function store(Request $request){
        $user = $request->validate([
            'profile_picture' => 'mimes:png,jpg,jpeg|required',
            'firstname' => 'required',
            'department' => 'required',
            'lastname' => 'required|alpha',
            'staff_id' => 'numeric|required',
            'phone_number' => 'numeric|required|digits:11|unique:users,phone_number',
            'date_of_birth' => 'date|required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'staff_level' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $dest = '/public/staffs';
        $path = $request->file('profile_picture')->store($dest);
        $user = User::create([
            'profile_picture' => str_replace('public/staffs/','',$path),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'department' => $request->department,
            'staff_id' => $request->staff_id,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'staff_level' => $request->staff_level,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard');
    }
}
