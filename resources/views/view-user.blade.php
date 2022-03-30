@extends('layouts.app')
@section('content')
<main class="w-full h-screen overflow-y-scroll">

            @include('layouts.nav')

   <div class="px-2 md:px-8 mt-2 bg-white shadow-md rounded-md py-4">
    <div class="px-3 md:px-8 mt-6 flex gap-x-2 justify-end">
        <a href="/edit/user/details/{{ $user->id }}" class="py-2 px-4 bg-blue-500 w-36 text-white rounded-full shadow-md text-center">Edit</a>
        <a href="/delete/user/{{ $user->id }}" class="py-2 px-5 bg-red-500 w-36 text-white rounded-full shadow-md text-center">Delete</a>
    </div>
    <div class="md:flex gap-x-4  px-6 py-4 mt-4">
        <div class="w-72 h-full mx-auto md:mx-0 mb-3 md:mb-0">
            <img src="{{ asset('/storage/staffs/' . $user->profile_picture) }}" class="w-72 block rounded shadow-md h-auto" alt="">
            <form action="/change/user/picture" class="mt-4" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="text" name="id" value="{{ $user->id }}" class="hidden">
                <label for="imagee"  class="px-6 py-2.5 bg-lime-500 text-white font-bold">Change Picture</label>
                <input type="file" onchange="this.form.submit()" name="image" class="hidden" id="imagee">
            </form>
        </div>
        <div class="w-full h-full">
            <h1 class="text-3xl font-bold text-gray-900">{{ $user->firstname . ' ' . $user->lastname }}</h1>

            <div class="flex gap-x-2 mt-4">
                <label class="text-green-500 text-md font-semibold">User ID: </label>
                <p class="text-md font-medium">{{ $user->staff_id }}</p>
            </div>
            <div class="flex gap-x-2 mt-4">
                <label class="text-green-500 text-md font-semibold">Department: </label>
                <p class="text-md font-medium">{{ $user->department }}</p>
            </div>
            <div class="flex gap-x-2 mt-2">
                <label class="text-green-500 text-md font-semibold">Email address: </label>
                <p class="text-md font-medium">{{ $user->email }}</p>
            </div>
            <div class="flex gap-x-2 mt-2">
                <label class="text-green-500 text-md font-semibold">Date of Birth: </label>
                <p class="text-md font-medium">{{ $user->date_of_birth }}</p>
            </div>
            <div class="flex gap-x-2 mt-2">
                <label class="text-green-500 text-md font-semibold">Gender: </label>
                <p class="text-md font-medium">{{ $user->gender }}</p>
            </div>
        </div>
    </div>
   </div>
</main>
@endsection
