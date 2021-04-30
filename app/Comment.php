<?php

namespace App;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'comment', 'post_id','user_id',
    ];

    public function post(){
        return $this->belongsTo(post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
