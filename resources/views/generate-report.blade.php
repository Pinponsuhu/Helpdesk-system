@extends('layouts.app')
@section('content')
    <main class="w-full h-screen overflow-y-scroll">
        @include('layouts.nav')
        <div class="px-3 md:px-6">
            <div class="mt-4 py-4 px-3 md:px-6 w-full h-screen overflow-y-scroll rounded-md bg-white">
                <h1 class="text-center font-bold text-xl md:text-2xl text-gray-900 mb-4">Generate Report</h1>
                <form action="/view/report" method="get" class="w-80 md:w-5/12 mx-auto">
                    @csrf
                    <div>
                        <label class="font-bold mb-2">From</label>
                        <input type="date" name="from" id="" class="border-2 border-lime-500  mt-2 py-3 px-3 w-full bg-white text-lime-500 block shadow-md">
                    </div>
                    <div class="mt-3">
                        <label class="font-bold mb-2">To</label>
                        <input type="date" name="to" id="" class="border-2 border-lime-500  mt-2 py-3 px-3 w-full bg-white text-lime-500 block shadow-md">
                    </div>
                    <button class="w-32 py-3 bg-lime-500 text-white text-center mx-auto rounded-md  mt-3 font-bold">Generate</button>
                </form>
            </div>
        </div>
    </main>
@endsection
