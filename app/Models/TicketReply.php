<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $table = 'ticket_replies';

    protected $primaryKey = 'id';

    protected $fillable = ['ticket_id','sender_id','message'];

    public function Ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function TicketReplyFile(){
        return $this->hasMany(TicketReplyFile::class);
    }

}
