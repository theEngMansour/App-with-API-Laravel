<?php

namespace App;
use App\Like;
use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'body', 'image_path','excerpt','user_id',
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
