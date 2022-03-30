<div class="py-3 h-20 items-center w-full bg-white flex justify-between px-10">
    <h1 class="text-2xl font-bold text-gray-900 px-10">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname}}</h1>
    <img src="{{ asset('/storage/staffs/' . auth()->user()->profile_picture) }}" onmouseover="mouse()" class="h-12 w-12 rounded-full shadow-md" alt="">
</div>
<div id="hov" onmouseout="mouseO()" onmouseover="mouseOn()" class="fixed top-16 hidden right-6 w-52 p-4 bg-white rounded-md shadow-md">
    <a href="/change/password" class="flex gap-x-2 py-3 border-b-2 items-center hover:bg-lime-100 text-gray-400 hover:rounded-md px-2"><i class="fa fa-lock text-green-500"></i>Change password</a>
    <form action="/logout" method="post">
    @csrf
    <button class="flex w-full gap-x-2 py-3 border-b-2 items-center hover:bg-lime-100 text-gray-400 hover:rounded-md px-2"><i class="fa fa-sign-out-alt text-green-500"></i>Logout</button>
    </form>
</div>
<script>
    function mouse(){
        document.getElementById('hov').classList.remove('hidden');
    }
    function mouseOn(){
        document.getElementById('hov').classList.remove('hidden');
    }
    function mouseO(){
        document.getElementById('hov').classList.add('hidden');
    }
</script>
