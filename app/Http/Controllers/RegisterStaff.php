<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterStaff extends Controller
{
    public function show(){
        if(auth()->user()->is_admin == true){
        return view('register');
        }else{
            abort(404);
        }
    }
    public function store(Request $request){
        // return true;
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
            'admin' => 'required',
            'ticket_permission' => 'required',
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
            'is_admin' => $request->admin,
            'ticket_permission' => $request->ticket_permission,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard');
    }

    public function view_generate(Request $request){

        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date'
        ]);

        $tasks = Ticket::whereBetween('created_at',[$request->from,$request->to])->orWhereBetween('created_at',[$request->to,$request->from])->get();

        return view('view-report',['tasks' => $tasks]);
    }
}
