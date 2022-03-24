<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{
    use HasFactory;

    protected $table = 'ticket_files';

    protected $primaryKey = 'id';

    protected $fillable = ['file_name','ticket_id'];

    public function Ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
