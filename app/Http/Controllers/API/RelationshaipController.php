<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Response;

class RelationshaipController extends Controller
{
    public function userPosts($id)
    {

        $user = User::findOrFail($id)->posts;
        $fields = array();
        $filtered = array();
        foreach ($user as $post) {

            $fields['Title'] = $post->title;
            $fields['Content'] = $post->body;
            $fields['User_id'] = $post->user_id;
            $filtered[] = $fields;
        }
        return Response::json([
            'data' => $filtered
        ], 200);
    }

    public function postComments($id)
    {
        $post = Post::findOrfail($id)->comments;
        $fields=array();
        $filtered=array();
        foreach($post as $comment)
        {
            $fields['Comment']= $comment->comment;
            $fields['User Id']= $comment->user_id;
            $fields['Post Id']= $comment->post_id;
            $filtered[]=$fields;
        }



        return Response::json([
            'data' => $filtered
        ], 200);
    }
    
}
