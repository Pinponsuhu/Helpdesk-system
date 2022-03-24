<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareFile extends Model
{
    use HasFactory;

    protected $table = 'share_files';

    protected $primaryKey = 'id';

    protected $fillable = ['file_name','share_details_id'];

    public function ShareDetails(){
        return $this->belongsTo(ShareDetails::class);
    }
}
