<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggedRequest extends Model
{
    use HasFactory;

    protected $table = 'tagged_requests';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id','user_fullname', 'ticket_id'];

    public function Ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
