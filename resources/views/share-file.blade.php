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
                        <h1 class="text-2xl font-bold">All Sent Files</h1>
                        <span onclick="show_send()" class="cursor-pointer px-6 py-2.5 font-bold text-white bg-lime-500 rounded-md">Send new</span>
                    </div>
                    <div class="mt-4">
                        @foreach ($sends as $send)
                        <div class="py-2.5 my-1 bg-lime-50 px-4">
                            <h1 class="mb-0.5">{{ $send->subject }}</h1>
                            @php
                                $reciever = App\Models\User::find($send->reciever_id);
                            @endphp
                            <span class="text-sm block mb-0.5 text-gray-500">Sent to: {{ $reciever->firstname . ' ' . $reciever->lastname }}</span>
                            <span class="text-sm block mb-1.5 text-gray-500">Sent Date: {{ $send->created_at->format('d/m/Y') }}</span>
                            @php
                                $files = App\Models\ShareFile::where('share_details_id',$send->id)->get();
                            @endphp

                            @foreach ($files as $file)
                            <div class="flex mt-2 items-center gap-x-3">
                                <a href="{{ '/storage/shared_file/'.$file->file_name }}" download="true" class="px-4 py-1 shadow-md font-medium rounded-full flex items-center bg-lime-500 gap-x-1 w-32 text-center text-white">Download <i class="fa fa-arrow-down text-md"></i></a>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="send-dialog" class="hidden w-screen h-screen fixed bg-gray-900 bg-opacity-75">
        <div class="mt-5 mr-5 flex justify-end">
            <i class="fa fa-times cursor-pointer fa-2x text-white" onclick="cls_send()"></i>
        </div>
            <div  class="mt-10 md:mt-16 w-80 md:w-96 mx-auto bg-white px-8 py-10">
                <h1 class="text-xl uppercase font-bold text-gray-900">Send a file</h1>
                <form action="/send/files" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input placeholder="Subject" name="subject" type="text" class="py-3 px-2 bg-white border-4 border-lime-400 mt-4 mb-2 block w-full">
                    <input type="file" name="files[]" class="py-3 px-2 border-4 bg-white border-lime-400 mt-4 mb-2 block w-full">
                    <select name="reciever" class="py-3 px-2 border-4 border-lime-400 mt-4 mb-2 block w-full" id="">
                        <option value="" disabled selected>-- Reciever --</option>
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->firstname . ' '. $staff->lastname }}</option>
                        @endforeach
                    </select>
                    <button class="font-bold text-white px-6 py-2 bg-blue-400 uppercase">Send</button>
                </form>
            </div>
    </div>

    <script>
        function show_send(){
            document.getElementById('send-dialog').classList.remove('hidden');
        }
        function cls_send(){
            document.getElementById('send-dialog').classList.add('hidden');
        }
    </script>
@endsection