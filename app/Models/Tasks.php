<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','tags_id','description','priority_id','timeToReady','user_id' ,'isReady'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
    function tags(){
        return $this->belongsTo(Tags::class);
    }
    function priority(){
        return $this->belongsTo(Priority::class);
    }
}
