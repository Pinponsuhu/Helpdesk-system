@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-3 md:px-6">
            <div class="mt-4 py-4 px-3 md:px-6 w-full rounded-md bg-white">
                <div class="h-80 py-4 flex flex-col md:flex-row gap-x-5 items-center px-8 md:px-20 bg-lime-400 text-white md:py-6 shadow-md rounded-md w-full">
                    <img src="{{ asset('img/lasu.png') }}" class="block w-40 md:w-52 h-auto" alt="">
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold">Lagos State University</h1>
                    <p class="mt-1.5 md:mt-3 text-md md:text-lg font-medium">For Easy Task assignment and file sharing</p>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center px-4 md:px-8 mt-6">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Tagged Ticket</h1>
                        <a href="/ticket/recieved/{{ Crypt::encrypt('Open') }}" class="py-2 px-5 rounded-md bg-lime-400 text-white font-bold">View All</a>
                    </div>
                    <div class="w-full overflow-x-scroll">
                        <table class="w-full mt-4">
                            <thead>
                                <tr class="p-3">
                                    <td class="w-1/6 text-gray-500 py-2 uppercase text-md font-bold">created By</td>
                                    <td class="w-1/6 text-gray-500 py-2 uppercase text-md font-bold">Subject</td>
                                    <td class="w-1/6 text-gray-500 py-2 uppercase text-md font-bold">Status</td>
                                    <td class="w-1/6 text-gray-500 py-2 uppercase text-md font-bold">Created On</td>
                                    <td class="w-1/6 text-gray-500 py-2 uppercase text-md font-bold">Assigned To</td>
                                </tr>
                            </thead>
                            <tbody class="mt-3">
                                @foreach ($requests as $request)
                                @php
                                // dd($request);
                                    $reqs = App\Models\Ticket::where('id',$request->ticket_id)->where('status',$status)->take(3)->get();
                                    // dd($req);
                                @endphp
                               @foreach ($reqs as $req)
                               @php
                                    $name = App\Models\User::find($req->created_by);
                                @endphp
                               <tr class="py-4 bg-lime-100 border-2 border-white px-3">
                                <td class="w-1/6 flex items-center gap-x-2 px-2 py-3"> {{ $name->firstname . ' ' . $name->lastname }}</td>
                            <td class="w-1/6 py-3">{{ Str::limit($req->subject, 24) }}</td>
                            <td class="w-1/6 py-3"><span class="px-3 py-1.5 bg-green-500 text-white rounded-sm">{{ $req->status }}</span></td>
                            <td class="w-1/6 px-2 py-3">{{ $req->created_at->format('d-m-Y') }}</td>
                            @php
                                $tags = App\Models\TaggedRequest::where('ticket_id',$req->id)->get();
                                $count_tag = App\Models\TaggedRequest::where('ticket_id',$req->id)->count();
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
                            <td><a href="/view/ticket/{{ Crypt::encrypt($request->ticket_id) }}" class="w-1/6 py-2 px-6 rounded-md bg-blue-500 text-white font-bold">View</a></td>
                            </tr>
                               @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    {{ $chart->script() }}
@endsection
