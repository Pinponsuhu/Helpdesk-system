@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-3 md:px-6 mt-4">
            <div class="bg-white py-8 px-3 md:px-6">
                <div class="">
                    <h1 class="text-2xl font-bold mb-4">Ticket Report</h1>
                    <span id="button-excel" class="px-5  bg-blue-400 cursor-pointer text-white font-bold py-2.5">Export Excel</span>
                    <div class="w-full md:px-8 mt-3 overflow-x-scroll mx-auto ">
                        <table class="w-full mt-4" id="resultTable">
                            <thead>
                                <tr class="p-3">
                                    <td class="text-gray-500 py-2 uppercase text-md font-bold">created By</td>
                                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Subject</td>
                                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Category</td>
                                    <td class="text-gray-500 py-2 uppercase text-md font-bold">Created On</td>
                                </tr>
                            </thead>
                            <tbody class="mt-3">
                                @foreach ($tickets as $ticket)
                                @php
                                    $user = App\Models\User::find($ticket->created_by)
                                @endphp
                                <tr class="py-4 bg-lime-100 border-2 border-white px-3">
                                    <td class="flex items-center gap-x-2 px-2 py-3"> {{ $user->firstname . ' ' . $user->lastname }}</td>
                                <td class="py-3">{{ $ticket->subject }}</td>
                                <td class="py-3">{{ $ticket->category }}</td>
                                <td class="px-2 py-3">{{ $ticket->created_at->format('d-m-Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </main>

    <script>

let button = document.querySelector("#button-excel");

button.addEventListener("click", e => {
  let table = document.querySelector("#resultTable");
  TableToExcel.convert(table);
});
    </script>
@endsection
