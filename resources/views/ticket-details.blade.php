@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white shadow-md">
                <div>
                    <h1 class="text-gray-900 text-2xl font-bold mb-2 mt-3">{{ $ticket->subject }}</h1>
                @php
                    $name = App\Models\User::find($ticket->created_by);
                @endphp
                <div class="flex items-center gap-x-4">
                    <p>Created by: {{ $name->firstname . ' ' . $name->lastname }}</p>
                    <p>Date created: {{ $ticket->created_at->format('d-m-Y') }}</p>
                </div>
                <div class="flex mt-2 items-center gap-x-4">
                    <p>Status: {{ $ticket->status }}</p>
                </div>
                <div class="flex gap-x-1 mt-2">
                    <p class="font-bold">Tagged Staffs: </p>
                    @foreach ($tags as $tag)
                    @if ($loop->last == true)
                    <p class="text-md font-medium text-gray-600"> {{ $tag->user_fullname }}</p>
                    @else
                    <p class="text-md font-medium text-gray-600"> {{ $tag->user_fullname }},</p>
                    @endif
                    @endforeach
                </div>
                <div class="mt-3">
                    <h3 class="font-bold mb-2">Description</h3>
                    <p>{{ $ticket->description }}</p>
                </div>
                <div>
                    <div class="mt-2">
                        <h3 class="font-bold mb-2">Files Attached</h3>
                        <div class="mt-2 flex gap-x-">
                            @foreach ($files as $file)
                                <a href="{{ '/storage/ticket_files/' . $file->file_name }}" download class="py-1 rounded-md px-5 bg-lime-400 font-bold text-white">Download</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="mt-2">
                </div>
                <div class="px-4 py-3">
                   @foreach ($replies as $reply)
                   @php
                       $sender = App\Models\User::find($reply->sender_id)
                   @endphp
                        <div>
                            <h1><b>Sent By:</b> {{ $sender->firstname . ' ' .$sender->lastname }}</h1>
                            <p>{{ $reply->message }}</p>
                            <span>{{ $reply->created_at->format('d-m-Y') }}</span>
                            @php
                                $reply_files = App\Models\TicketReplyFile::where('ticket_reply_id',$reply->id)->get();
                            @endphp
                            <div class="mt-2">
                                @foreach ($reply_files as $reply_file)
                                <a href="{{ '/storage/ticket_reply_files/' . $reply_file->file_name }}" download class="py-1 rounded-md px-5 bg-lime-400 font-bold text-white">Download</a>
                                @endforeach
                            </div>
                        </div>
                        <hr class="mt-2">
                   @endforeach
                </div>
                @if ($ticket->status == 'Open')
                <span onclick="reply()" class="px-6 cursor-pointer py-2 uppercase text-white font-bold bg-blue-500 block mt-2 w-24 text-center">Reply</span>
                @endif
            </div>
        </div>
    </main>
    <div id="reply-modal" class="fixed w-screen h-screen top-0 hidden bg-gray-800 bg-opacity-90">
        <div class="mt-6 flex mr-4 justify-end">
            <i onclick="hideReply()" class="fa fa-times fa-2x text-white cursor-pointer"></i>
        </div>
        <div  class="w-80 md:w-96 px-8 py-10 bg-white rounded-md mx-auto">
            <h1 class="text-xl font-bold uppercase text-gray-900 mb-4">Send a reply</h1>
            <form enctype="multipart/form-data" action="/reply/request/{{ Crypt::encrypt($ticket->id) }}" method="post">
                @csrf
                <label class="block font-bold mb-2">Message</label>
                <textarea name="message" id="" cols="30" placeholder="Message goes here" class="resize-none bg-white p-1 block w-full border-4 border-lime-400" rows="2"></textarea>
                <div>
                    <label class="block font-bold mb-2"><b>File</b>(Optional)</label>
                    <input type="file" multiple name="files[]" class="bg-white p-1.5 block w-full border-4 border-lime-400" id="">
                </div>
                @if ($ticket->created_by == auth()->user()->id)
                    <label class="block font-bold mb-2">Set Status</label>
                    <select name="status" class="bg-white p-1.5 block w-full border-4 border-lime-400" id="">
                        <option value="">-- Set Status --</option>
                        <option value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
                @endif

                <button class="py-2.5 px-6 w-24 block text-center mt-3 bg-blue-500 text-white font-bold uppercase">Send</button>
            </form>
        </div>
    </div>
    <script>
        function reply(){
            document.getElementById('reply-modal').classList.remove('hidden');
        }
        function hideReply(){
            document.getElementById('reply-modal').classList.add('hidden');
        }
    </script>
@endsection
