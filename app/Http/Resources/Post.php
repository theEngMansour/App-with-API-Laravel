<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Comment as CommentResource;
class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Title Post'=>$this->title,
            'Excerpt' =>$this->excerpt,
            'Body Post'=>$this->body,
            'User Id'=>$this->user_id,
            'Comments' => CommentResource::collection($this->comments),
        ];
    }
}
