@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-6">
            <div class="mt-4 py-4 px-6 w-full rounded-md bg-white shadow-md">
                <h1 class="text-gray-900 text-2xl font-bold text-center mb-4 mt-3">Add New Ticket</h1>
                <form action="{{ route('add_ticket') }}" method="post" class="w-8/12 grid grid-cols-2 gap-x-4 items-end px-6 mx-auto" enctype="multipart/form-data">
                    @csrf
                    <div class="flex gap-x-3 items-center py-3 border-2 border-lime-500 px-3 shadow-md rounded-md">
                        <i class="fa fa-envelope text-lime-500 text-xl"></i>
                        <input type="text" name="subject" class="outline-none w-full rounded-md flex" placeholder="Subject">
                    </div>
                    <select name="category" onchannge="it()" class="py-3 w-full bg-white border-2 border-lime-500 shadow mt-3 rounded-md" id="">
                        <option value="" disabled selected>-- Category --</option>
                        <option value="IT">IT</option>
                        <option value="Welfare">Welfare</option>
                        <option value="Inventory">Inventory</option>
                    </select>
                    <div>
                        <label class="block mt-2 font-bold">Tag Staff</label>
                        <div id="selects" class="flex flex-col gap-x-2  items-center">
                            <select id="tag" multiple name="tag[]" class="py-2.5  h-12 mt-1.5 w-full bg-white border-2 border-lime-500 shadow  rounded-md" id="">
                        @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->firstname . ' ' . $staff->lastname }}</option>
                        @endforeach
                            </select>
                        </div>
                        {{-- <span onclick="clone()" class="cursor-pointer w-32 mx-auto py-2 mt-2 text-center block bg-lime-500 text-white rounded-md shadow-md">Tag New</span> --}}

                    </div>
                    <div>
                        <label class="block mt-2 font-bold">File(Optional)</label>
                        <input type="file" name="files[]" multiple class="border-2 border-lime-400 py-3 mt-2 text-lime-500 block outline-none rounded-md w-full bg-white shadow-md px-3">
                    </div>
                    <textarea name="desc" id="" cols="30" rows="6" class="w-full col-span-2 border-2 outline-none border-lime-500 px-2 py-3 rounded-md shadow-md mt-2 resize-none" placeholder="Ticket Description"></textarea>
                    <button class="w-32 py-3 block m-4 mx-auto bg-lime-500 hover:bg-lime-600 outline-none text-white text-center rounded-md font-bold ">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        function clone(){
            // alert("shabz");
            const node = document.getElementById("tag");
const clone = node.cloneNode(true);

document.getElementById("selects").appendChild(clone);
        }

    // function it()
    </script>
@endsection
