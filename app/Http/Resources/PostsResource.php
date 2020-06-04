<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;
use Auth;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'links' => $this->links,
        'author' => $this->author,
        'user' => new UserResource($this->user),
        'image' => asset('images/posts/' . $this->image),
        'like_count' => $this->getLikeCount(),
        'comment_count' => $this->commentCount(),
        'comments' => CommentResource::collection($this->getComment())
        ];      
    }
}
