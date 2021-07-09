<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
}
