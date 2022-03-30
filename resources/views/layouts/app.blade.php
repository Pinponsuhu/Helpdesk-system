<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LASU Helpdesk - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/tableToExcel.js') }}"></script>
</head>
<body class="bg-lime-50 text-gray-900 flex">
    <nav id="side-nav" class="w-72 fixed shadow-md md:shadow-none hidden md:block top-0 left-0 md:relative h-screen overflow-h-scroll bg-white pb-6">
        <h1 class="flex bg-lime-300 rounded-bl-md rounded-br-md text-lime-50 shadow py-5 text-2xl font-bold gap-x-3 px-4 items-center"><img src="{{ asset('img/lasu.png') }}" class="h-11 w-11" alt=""> LASU-HDK</h1>
        <ul class="font-bold px-2 mt-3">
            <li class="py-4 rounded-md my-1.5 px-3 hover:bg-lime-100"><a href="{{ route('dashboard') }}" class="text-lg flex items-center gap-x-2 text-gray-800"><i class="fa fa-users text-lime-400 text-xl"></i>Dashboard</a></li>
            @if (auth()->user()->ticket_permission == true)
            <li class="py-4 rounded-md my-1.5 px-3 hover:bg-lime-100"><a href="/helpdesk/{{ Crypt::encrypt('Open') }}" class="text-lg flex items-center gap-x-4 text-gray-800"><i class="fa fa-envelope text-lime-400 text-xl"></i>Helpdesk</a></li>
            @else
            <li class="py-4 rounded-md my-1.5 px-3 hover:bg-lime-100"><a href="/ticket/recieved/{{ Crypt::encrypt('Open') }}" class="text-lg flex items-center gap-x-4 text-gray-800"><i class="fa fa-envelope text-lime-400 text-xl"></i>Helpdesk</a></li>
            @endif
            @if (auth()->user()->is_admin == true)
            <li class="py-4 rounded-md  my-1.5 px-3 hover:bg-lime-100 active:bg-lime-100"><a href="{{ route('report') }}" class="text-lg flex items-center gap-x-5 text-gray-800"><i class="fa fa-file text-lime-400 text-xl"></i>Reports</a></li>
            @endif
            <li class="py-4 rounded-md  my-1.5 px-3 hover:bg-lime-100"><a href="{{ route('share') }}" class="text-lg flex items-center gap-x-5 text-gray-800"><i class="fa fa-share-alt text-lime-400 text-xl"></i>Share Files</a></li>
            @if (auth()->user()->is_admin == true)
            <li class="py-4 rounded-md  my-1.5 px-3 hover:bg-lime-100"><a href="/all/users" class="text-lg flex items-center gap-x-4 text-gray-800"><i class="fa fa-users text-lime-400 text-xl"></i>Users</a></li>
            @endif
        </ul>
    </nav>

    <div class="top-12 md:hidden right-4 p-3 fixed bg-white shadow-md rounded-md ">
        <i onclick="navv()" class="fa fa-bars fa-2x text-lime-400"></i>
    </div>
    @yield('content')
</body>
<script>
    function navv(){
        document.getElementById('side-nav').classList.toggle('hidden');
    }
</script>
</html>
