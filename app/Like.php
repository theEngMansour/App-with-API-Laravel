<?php
use App\User;
use App\Post;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function post(){
        return $this->belongsTo(post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
