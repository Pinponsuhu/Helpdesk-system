@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white">
                <img src="{{ asset('/storage/staffs/' . auth()->user()->profile_picture) }}" class="h-40 shadow-md border-2 border-lime-500 w-40 rounded-full block mx-auto" alt="">
                <a href="#" class="bg-lime-500 font-bold gap-x-3 text-white py-2  rounded-md w-36 text-center mx-auto flex items-center justify-center my-3"><i class="fa fa-image text-xl"></i> Change <i class=""></i></a>

                <form action="" class="w-9/12 grid grid-cols-3 gap-x-4 mx-auto mt-6 py-4">
                    @csrf

                    <div class="my-4">
                        <label class="font-bold block mb-2">Firstname</label>
                        <input type="text" value="{{ auth()->user()->firstname }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Firstname">
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Lastname</label>
                        <input type="text" value="{{ auth()->user()->lastname }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Lastname">
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Department</label>
                        <input type="text" value="{{ auth()->user()->department }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Department">
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Date of Birth</label>
                        <input type="date" value="{{ auth()->user()->date_of_birth }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md">
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Phone Number</label>
                        <input type="text" value="{{ auth()->user()->phone_number }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Phone Number">
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Email address</label>
                        <input type="text" value="{{ auth()->user()->email }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Email Address">
                    </div>
                    <button class="col-span-3 mx-auto w-32 bg-blue-500 py-3 block text-white font-bold">Update</button>
                </form>
            </div>
        </div>
    </main>
@endsection