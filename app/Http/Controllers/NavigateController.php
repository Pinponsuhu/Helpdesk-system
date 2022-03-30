<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Charts\Report;
use App\Models\ShareDetails;
use App\Models\ShareFile;
use App\Models\TaggedRequest;
use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\TicketReply;
use App\Models\TicketReplyFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\VarDumper\Dumper\esc;

class NavigateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(MonthlyUsersChart $chart){
        $requests = TaggedRequest::where('user_id',auth()->user()->id)->get();
        return view('dashboard',['chart' => $chart->build(),'requests'=> $requests,'status' => 'Open']);
    }

    public function helpdesk($status){
            if(auth()->user()->ticket_permission == true){
            $requests = Ticket::where('created_by',auth()->user()->id)->where('status', Crypt::decrypt($status))->get();
            return view('helpdesk',['requests' => $requests]);
            }else{
                abort(404);
            }
    }
    public function recieved_ticket($status){
            $requests = TaggedRequest::where('user_id',auth()->user()->id)->get();
        // dd($requests);
        return view('recieved-ticket',['requests' => $requests,'status' => Crypt::decrypt($status)]);
    }
    public function share(){
        $staffs = User::where('id','!=', auth()->user()->id)->get();
        $sends = ShareDetails::latest()->where('sender_id',auth()->user()->id)->paginate(15);
        return view('share-file',['staffs'=> $staffs,'sends' => $sends]);
    }
    public function send_file(Request $request){
        $request->validate([
            'subject' =>'required',
            'files.*' => 'required|mimes:png,jpg,jpeg,xlsx,xls,doc,docx,html,pdf',
            'files' => 'required',
            'reciever' => 'required|numeric'
        ]);

        $details = new ShareDetails;

        $details->subject = $request->subject;
        $details->reciever_id = $request->reciever;
        $details->sender_id = auth()->user()->id;
        $details->save();

        if($request->hasFile('files')){
            $filess = new ShareFile;

            foreach($request->file('files') as $single){
                $dest = 'public/shared_file/';

                $path = $single->store($dest);

                $filess->file_name = str_replace('/public/shared_file/','',$path);
                $filess->share_details_id = $details->id;
                $filess->save();

                return redirect()->route('share');

            }
        }


    }
    public function recieved(){
        $recieves = ShareDetails::latest()->where('reciever_id',auth()->user()->id)->paginate(15);
        return view('recieve-file',['recieves' => $recieves]);
    }
    public function report(){
        if(auth()->user()->is_admin == true){
        return view('generate-report');
        }else{
            abort(404);
        }
    }

    public function add_ticket(){
        if(auth()->user()->is_admin == true){
        $staffs = User::where('id','!=', auth()->user()->id)->get();
        return view('add-ticket',['staffs' => $staffs]);
        }else{
            abort(404);
        }
    }
    public function store_ticket(Request $request){
        $request->validate([
            'subject'=> 'required',
            'category' => 'required',
            'tag' => 'required',
            'files.*' => 'mimes:png,jpg,jpeg,html,pdf,xlsx,xls,csv,docx,doc,txt',
            'desc' => 'required'
        ]);
        // dd($request->all());
        $ticket = new Ticket;

        $ticket->subject = $request->subject;
        $ticket->category = $request->category;
        $ticket->description = $request->desc;
        $ticket->status = 'Open';
        $ticket->created_by = auth()->user()->id;
        $ticket->save();
        foreach($request->tag as $tag){
            $tagg = new TaggedRequest;
            // dd($tag);
            $full = User::find($tag);

            $tagg->user_id = $tag;
            $tagg->user_fullname = $full->firstname . ' ' . $full->lastname;
            $tagg->ticket_id = $ticket->id;
            $tagg->save();
        }

        if($request->hasFile('files')){
            $dest = 'public/ticket_files';
            foreach($request->file('files') as $file){
                $ticket_file = new TicketFile;
                $path = $file->store($dest);
                $ticket_file->file_name = str_replace('public/ticket_files/','',$path);
                $ticket_file->ticket_id = $ticket->id;
                $ticket_file->save();
            }
        }

        return redirect()->route('dashboard');
    }

    public function ticket_details($id){
        $ticket = Ticket::find(Crypt::decrypt($id));
        $tags = TaggedRequest::where('ticket_id',Crypt::decrypt($id))->get();
        $files = TicketFile::where('ticket_id',Crypt::decrypt($id))->get();
        // dd($tags);
        $replies = TicketReply::where('ticket_id',Crypt::decrypt($id))->get();
        return view('ticket-details',['ticket' => $ticket,'tags' => $tags,'files' => $files,'replies' => $replies]);
    }

    public function send_reply(Request $request){
        $request->validate([
            'message' => 'required',
            'files.*' => 'mimes:png,jpg,jpeg,pdf,html,txt,docx,doc,xlsx,xls',
        ]);
        if(auth()->user()->ticket_permission == true){
            $request->validate([
                'status' => 'required'
            ]);
        }

        // dd($request->all());

        $reply = new TicketReply;

        $reply->sender_id = auth()->user()->id;
        $reply->message = $request->message;
        $reply->ticket_id = Crypt::decrypt($request->ticket);
        $reply->save();

        if($request->hasFile('files')){
            $dest = 'public/ticket_reply_files';
            foreach($request->file('files') as $file){
                $ticket_file = new TicketReplyFile;
                $path = $file->store($dest);
                $ticket_file->file_name = str_replace('public/ticket_reply_files/','',$path);
                $ticket_file->ticket_reply_id = $reply->id;
                $ticket_file->save();
            }
    }

    $ticket = Ticket::find(Crypt::decrypt($request->ticket));
    if($ticket->created_by == auth()->user()->id){
        $ticket->status = $request->status;
        $ticket->save();
    }

    return redirect()->back();
}

public function all_users(){
    if(auth()->user()->is_admin == true){
    $users = User::where('is_admin',false)->paginate(13);

    return view('all-users',['users' => $users]);
    }else{
        abort(404);
    }
}

public function view_generate(Request $request){

    $request->validate([
        'from' => 'required|date',
        'to' => 'required|date'
    ]);

    $tickets = Ticket::whereBetween('created_at',[$request->from,$request->to])->orWhereBetween('created_at',[$request->to,$request->from])->get();

    return view('report-result',['tickets' => $tickets]);
}

public function change_password(){
    return view('change-password');
}

public function store_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::find(auth()->user()->id);

        $user->password = Hash::make($request->password);
        $user->save();

        auth()->logout();

        return redirect('/login');
    }

    public function logout(){
        auth()->logout();

        return redirect('/login');
    }

    public function view_user($id){
        if(auth()->user()->is_admin == true){
        $user = User::find($id);

        return view('view-user',['user' => $user]);
        }else{
            abort(404);
        }
    }

    public function update_image(Request $request){
        // dd($request->id);
        if(auth()->user()->is_admin == true){
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $dest = '/public/staffs';
        $path = $request->file('image')->store($dest);
        $user = User::find($request->id);
        $user->profile_picture = str_replace('public/staffs/','',$path);
        $user->save();

        return redirect()->back();
    }else{
        abort(404);
    }
    }

    public function show_edit($id){
        if(auth()->user()->is_admin == true){
        $user = User::find($id);
        $genders = array("Male","Female");
        $pers = array(0,1);
        return view('edit-user', ['user' => $user,'genders' => $genders,'pers' => $pers]);
        }else{
            abort(404);
        }
    }

    public function edit_user(Request $request){
         $request->validate([
            'firstname' => 'required',
            'department' => 'required',
            'lastname' => 'required|alpha',
            'staff_id' => 'numeric|required',
            'phone_number' => 'numeric|required|digits:11',
            'date_of_birth' => 'date|required',
            'gender' => 'required',
            'email' => 'required|email',
            'ticket_permission' => 'required',
        ]);

        $user = User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->staff_id = $request->staff_id;
        $user->department = $request->department;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->ticket_permission = $request->ticket_permission;
        $user->save();

        return redirect('/all/users');
    }

    function delete_user($id){
        $user = User::find($id);
        $user->delete();

        return redirect('/all/users');
    }
}
