@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
                <form action="/edit/user/details/{{ $user->id }}" method="POST" class="w-8/12 grid md:grid-cols-2 lg:grid-cols-3 gap-x-4 mx-auto mt-6 py-4">
                    @csrf
                    <div class="my-4">
                        <label class="font-bold block mb-2">Staff ID</label>
                        <input type="text" name="staff_id" value="{{ $user->staff_id }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Staff ID">
                        @error('staff_id')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Firstname</label>
                        <input type="text" name="firstname" value="{{ $user->firstname }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Firstname">
                        @error('firstname')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Lastname</label>
                        <input type="text" name="lastname" value="{{ $user->lastname }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Lastname">
                        @error('lastname')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Department</label>
                        <input type="text" name="department" value="{{ $user->department }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Department">
                        @error('department')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md">
                        @error('date_of_birth')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Phone Number">
                        @error('phone_number')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Email address</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" placeholder="Enter Email Address">
                        @error('email')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Gender</label>
                        <select name="gender" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" id="">
                            <option value="{{ $user->gender }}">{{ $user->gender }}</option>
                            @foreach ($genders as $gender)
                                @if ($gender != $user->gender)
                                <option value="{{ $gender }}">{{ $gender }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('gender')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label class="font-bold block mb-2">Ticket Permission</label>
                        <select name="ticket_permission" class="py-3 border-2 border-lime-500 px-3 block w-full bg-white shadow-md" id="">
                            <option value="{{ $user->ticket_permission }}">{{ $user->ticket_permission }}</option>
                            @foreach ($pers as $per)
                                @if ($per != $user->ticket_permission)
                                <option value="{{ $per }}">{{ $per }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('ticket_permission')
                            <p class="text-sm my-2 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="md:col-span-2 lg:col-span-3 mx-auto w-32 bg-blue-500 py-3 block text-white font-bold">Update</button>
                </form>
            </div>
        </div>
    </main>
@endsection
