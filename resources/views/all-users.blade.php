@extends('layouts.app')
@section('content')
<main class="w-full h-screen overflow-y-scroll">
    @include('layouts.nav')
    <div class="px-3 md:px-6">
        <div class="mt-4 py-4 px-3 md:px-6 w-full rounded-md bg-white">
            <div class="flex justify-between items-center my-4">
                <h1 class="text-xl md:text-2xl font-bold text-lime-400">All users</h1>
                <a href="/register/staff" class="px-5 py-2 bg-lime-400 text-white font-bold">Add Staff</a>
            </div>
    <div class="w-full overflow-x-scroll">
        <table class="w-full mt-4">
            <thead>
                <tr class="p-3">
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Fullname</td>
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">ID number</td>
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Department</td>
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Email</td>
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Phone Number</td>
                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Ticket permission</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="p-3">
                    <td class="text-gray-500 py-3capitalize pl-1 text-md font-medium bg-lime-100">{{ $user->firstname . ' ' . $user->lastname }}</td>
                    <td class="text-gray-500 py-3 text-md font-medium bg-lime-100">{{ $user->staff_id }}</td>
                    <td class="text-gray-500 py-3capitalize text-md font-medium bg-lime-100">{{ $user->department }}</td>
                    <td class="text-gray-500 py-3 text-md font-medium bg-lime-100">{{ $user->email }}</td>
                    <td class="text-gray-500 py-3 text-md font-medium bg-lime-100">{{ $user->phone_number }}</td>
                    <td class="text-gray-500 py-3capitalize text-md font-medium bg-lime-100">{{ $user->ticket_permission }}</td>
                    <td class="bg-lime-100 py-3"><a href="/view/user/{{ $user->id }}" class="py-2 px-6 rounded-md bg-blue-500 text-white font-bold">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>

</main>
@endsection
