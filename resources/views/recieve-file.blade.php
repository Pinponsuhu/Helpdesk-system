@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white">
                <div class="flex justify-center items-center gap-x-3">
                    <a href="{{ route('share') }}" class="px-7 py-1.5 border-2 border-lime-500 text-lime-500 rounded-md font-bold">Sent</a>
                    <a href="{{ route('recieved') }}" class="px-7 py-1.5 border-2 border-lime-500 text-lime-500 rounded-md font-bold">Recieve</a>
                </div>
                <div class="w-full">
                    <div class="flex justify-between items-center mt-4">
                        <h1 class="text-xl md:text-2xl font-bold">All Recieved Files</h1>
                    </div>
                    <div class="mt-4">
                        @foreach ($recieves as $recieve)
                        <div class="py-2.5 my-1 bg-lime-50 px-4">
                            <h1 class="mb-0.5">{{ $recieve->subject }}</h1>
                            @php
                                $sender = App\Models\User::find($recieve->sender_id);
                            @endphp
                            <span class="text-sm block mb-0.5 text-gray-500">Sent by: {{ $sender->firstname . ' ' . $sender->lastname }}</span>
                            <span class="text-sm block mb-1.5 text-gray-500">Recieved date: {{ $recieve->created_at->format('d/m/Y') }}</span>
                            @php
                                $files = App\Models\ShareFile::where('share_details_id',$recieve->id)->get();
                            @endphp

                            @foreach ($files as $file)
                                <div class="flex mt-2 items-center gap-x-3">
                                    <a href="{{ '/storage/shared_file/'.$file->file_name }}" download class="px-4 py-1 shadow-md rounded-full flex items-center bg-lime-500 gap-x-1 w-32 text-center text-white">Download <i class="fa fa-arrow-down text-md"></i></a>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
