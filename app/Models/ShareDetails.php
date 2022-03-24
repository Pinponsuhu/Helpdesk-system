<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareDetails extends Model
{
    use HasFactory;

    protected $table = 'share_details';

    protected $primaryKey = 'id';

    protected $fillable = ['subject','recieve_id','sender_id'];

    public function ShareFile(){
        return $this->hasMany(ShareFile::class);
    }
}
