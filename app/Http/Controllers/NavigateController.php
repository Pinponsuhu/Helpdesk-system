<?php

namespace App\Http\Controllers;

use App\Charts\Report;
use App\Models\ShareDetails;
use App\Models\ShareFile;
use App\Models\TaggedRequest;
use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\User;
use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Report $chart){
        return view('dashboard',['chart' => $chart->build()]);
    }

    public function helpdesk(){
        $requests = Ticket::where('created_by',auth()->user()->id)->get();
        return view('helpdesk',['requests' => $requests]);
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
        $recieves = ShareDetails::latest()->where('sender_id',auth()->user()->id)->paginate(15);
        return view('recieve-file',['recieves' => $recieves]);
    }
    public function report(){
        return view('generate-report');
    }
    public function settings(){
        return view('settings');
    }
    public function add_ticket(){
        $staffs = User::where('id','!=', auth()->user()->id)->get();
        return view('add-ticket',['staffs' => $staffs]);
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

            return redirect()->route('dashboard');
        }
    }
}
