<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $fillable = ['subject','category','description','created_by','status'];

    public function TaggedRequest(){
        return $this->hasMany(TaggedRequest::class);
    }

    public function TicketFile(){
        return $this->hasMany(TicketFile::class);
    }
}
