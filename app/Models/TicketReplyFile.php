<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReplyFile extends Model
{
    use HasFactory;

    protected $table = 'ticket_reply_files';

    protected $primaryKey = 'id';

    protected $fillable = ['ticket_reply_id','file_name'];

    public function TicketReply(){
        return $this->belongsTo(TicketReply::class);
    }
}
