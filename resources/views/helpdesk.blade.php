@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white">
                <div class="flex justify-between items-center gap-x-8">
                    <div class="flex justify-between items-center gap-x-4">
                        <h1 class="text-2xl font-medium text-lime-400">All Sent Tickets</h1>
                    <div class="flex items-center gap-x-3">
                        <label class="text-md font-medium text-gray-500">Sort By:</label>
                        <select name="" class="py-2 px-6 outline-none bg-white text-lime-400" id="">
                            <option value="Date Created">Date Created</option>
                            <option value="Name">Name</option>
                            <option value="Status">Status</option>
                        </select>
                    </div>
                    </div>
                    @if (auth()->user()->staff_level == 1)
                    <a href="{{ route('add_ticket') }}" class="bg-lime-400 text-white font-medium py-2 rounded-md px-7"><i class="fa fa-plus"></i> Add Ticket</a>
                    @endif
                </div>
                <table class="w-full mt-4">
                    <thead>
                        <tr class="p-3">
                            <td class="text-gray-500 py-2 uppercase text-md font-bold">created By</td>
                            <td class="text-gray-500 py-2 uppercase text-md font-bold">Subject</td>
                            <td class="text-gray-500 py-2 uppercase text-md font-bold">Status</td>
                            <td class="text-gray-500 py-2 uppercase text-md font-bold">Created On</td>
                            <td class="text-gray-500 py-2 uppercase text-md font-bold">Assigned To</td>
                        </tr>
                    </thead>
                    <tbody class="mt-3">
                        @foreach ($requests as $request)
                        <tr class="py-4 bg-lime-100 border-2 border-white px-3">
                            <td class="flex items-center gap-x-2 px-2 py-3"> {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</td>
                        <td class="py-3">{{ Str::limit($request->subject, 24) }}</td>
                        <td class="py-3"><span class="px-3 py-1.5 bg-green-500 text-white rounded-sm">{{ $request->status }}</span></td>
                        <td class="px-2 py-3">{{ $request->created_at->format('d-m-Y') }}</td>
                        @php
                            $tags = App\Models\TaggedRequest::where('ticket_id',$request->id)->get();
                            $count_tag = App\Models\TaggedRequest::where('ticket_id',$request->id)->count();
                            // dd($tags[0]);
                        @endphp
                        <td class="px-2 py-3">@if ($count_tag == 1 )
                            {{ $tags[0]->user_fullname }}
                        @else
                        {{ $tags[0]->user_fullname }} + {{ $count_tag - 1 }} @if ($count_tag - 1 > 1)
                        others
                        @else
                        other
                        @endif
                        @endif</td>
                        <td><a href="#" class="py-2 px-6 rounded-md bg-blue-500 text-white font-bold">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
        </div>
    </main>
@endsection