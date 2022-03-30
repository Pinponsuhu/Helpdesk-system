<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LASU - Helpdesk</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-lime-500">
    <div class="grid md:grid-cols-2 overflow-hidden w-80  md:w-10/12 lg:w-8/12 mt-14 rounded-md shadow-gray-300 shadow-sm mx-auto items-center justify-center">
        <div class="hidden md:block">
            <img src="{{ asset('img/img.jpg') }}" class="w-full h-full" alt="">
        </div>
        <div class="bg-white h-full py-10 px-8 md:px-10 lg:px-20">
            <h1 class="text-3xl font-bold uppercase text-lime-300">Sign in</h1>
            @if (session('status'))
                    <p class="text-red-500 font-bold text-center my-3">{{ session('status') }}</p>
            @endif
            <form action="{{ route('login') }}" method="POST" class="flex flex-col mt-8 gap-y-6">
                @csrf
                <input type="text" name="staff_id" placeholder="Staff ID" class="block p-3 bg-white rounded-md text-lime-300 placeholder-lime-300 shadow-md">
                <input type="password" name="password" placeholder="Password" class="block p-3 bg-white rounded-md text-lime-300 placeholder-lime-300 shadow-md">
                <div class="flex justify-between items-center">
                    <div class="flex gap-x-1 items-center">
                        <input type="checkbox" class="bg-white" name="remember_me" id="">
                        <p class="text-medium">Remember me</p>
                    </div>
                    <a href="#" class="flex justify-end text-sm">Forgot Password?</a>
                </div>
                <button class="py-3 px-6 bg-lime-500 font-bold text-white rounded-md">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>
