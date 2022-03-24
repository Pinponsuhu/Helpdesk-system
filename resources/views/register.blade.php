@extends('layouts.app')
@section('content')
    <main class="w-full">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white">
                <h1 class="text-2xl font-bold mt-2 uppercase text-gray-800 ml-5">Add New Staff</h1>
                <form action="/register/staff" autocomplete="off" method="post" enctype="multipart/form-data" class="w-9/12 grid grid-cols-3 gap-x-4 items-center mx-auto mt-6 py-4">
                    @csrf
                    <div class="my-4">
                        <label class="font-bold block mb-2">Profile Picture</label>
                        <input type="file" name="profile_picture" class="py-2.5 border-2 border-lime-500 px-3 block w-full bg-white shadow-md">
                        @error('profile_picture')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Staff ID</label>
                        <input type="text" name="staff_id" value="{{ old('staff_id') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Staff ID">
                        @error('staff_id')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Firstname</label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Firstname">
                        @error('firstname')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Lastname</label>
                        <input type="text" name="lastname" value="{{ old('lastname') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Lastname">
                        @error('lastname')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Department</label>
                        <input type="text" name="department" value="{{ old('department') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Department">
                        @error('department')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md">
                        @error('date_of_birth')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Staff level</label>
                        <select name="staff_level"  class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" id="">
                            <option value="" disabled selected>-- Staff Level --</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                        @error('staff_level')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Gender</label>
                        <select name="gender"  class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" id="">
                            <option value="" disabled selected>-- Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Phone Number">
                        @error('phone_number')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Email address</label>
                        <input type="text" name="email" value="{{ old('email') }}" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Email Address">
                        @error('email')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Password</label>
                        <input type="password" name="password" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Password">
                        @error('password')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" autocomplete="off" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Confirm Password">
                    </div>
                    <button class="col-span-3 rounded mx-auto w-32 bg-blue-500 py-3 block text-white font-bold">Register</button>
                </form>
            </div>
        </div>
    </main>
@endsection