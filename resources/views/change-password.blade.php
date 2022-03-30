@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-2 md:px-5 mt-4">
            <div class="bg-white py-8 md:px-5 lg:px-10 px-3">
                <h1 class="text-2xl font-bold mb-4">Change Password</h1>
                <div class="w-full mx-auto gap-x-2">
                    <form action="/change/password" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="font-bold mb-1 block">New password</label>
                            <input type="password" name="password" placeholder="Input New Password" class="w-full md:w-80 py-3 border-b-4 block shadow-md border-lime-400 px-1">
                        </div>
                        <div class="mb-4">
                            <label class="font-bold mb-1 block">Confirm password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm password" class="w-full md:w-80 py-3 border-b-4 block shadow-md border-lime-400 px-1">
                        </div>
                        <button class="py-3 px-6 bg-blue-500 text-white font-bold">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
