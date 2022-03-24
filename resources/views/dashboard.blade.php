@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white">
                <div class="h-80 px-20 py-6 shadow-md rounded-md w-full">
                    {!! $chart->container() !!}
                </div>
                <div>
                    <div class="flex justify-between items-center px-8 mt-6">
                        <h1 class="text-2xl font-bold text-gray-900">Ticket History</h1>
                        <a href="#" class="py-2 px-5 rounded-md bg-lime-400 text-white font-bold">View All</a>
                    </div>
                    <table class="w-full mt-4">
                        <thead>
                            <tr class="p-3">
                                <td class="text-gray-500 py-2 uppercase text-md font-bold">Requested By</td>
                                <td class="text-gray-500 py-2 uppercase text-md font-bold">Subject</td>
                                <td class="text-gray-500 py-2 uppercase text-md font-bold">Status</td>
                                <td class="text-gray-500 py-2 uppercase text-md font-bold">Created On</td>
                                <td class="text-gray-500 py-2 uppercase text-md font-bold">Assigned To</td>
                            </tr>
                        </thead>
                        <tbody class="mt-3">
                            <tr class="py-4 bg-lime-100 rounded-md px-3">
                                <td class="flex rounded-tl-md items-center gap-x-2 px-2 py-3"><img src="{{ asset('img/img.jpg') }}" class="h-10 w-10 rounded-full shadow-md" alt=""> Pinponsuhu Joseph</td>
                            <td class="py-3">E don de tire me</td>
                            <td class="py-3"><span class="px-3 py-1.5 bg-green-500 text-white rounded-sm">Open</span></td>
                            <td class="px-2 py-3 rounded-tr-md rounded-br-md">21st December 2021</td>
                            <td class="px-2 py-3 rounded-tr-md rounded-br-md">Daddy the father</td>
                            </tr>
                            <tr class="py-4 mt-2 bg-lime-100 rounded-md px-3">
                                <td class="flex rounded-tl-md items-center gap-x-2 px-2 py-3"><img src="{{ asset('img/img.jpg') }}" class="h-10 w-10 rounded-full shadow-md" alt=""> Pinponsuhu Joseph</td>
                            <td class="py-3">E don de tire me</td>
                            <td class="py-3"><span class="px-3 py-1.5 bg-green-500 text-white rounded-sm">Open</span></td>
                            <td class="px-2 py-3 rounded-tr-md rounded-br-md">21st December 2021</td>
                            <td class="px-2 py-3 rounded-tr-md rounded-br-md">Daddy the father</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    {{ $chart->script() }}
@endsection