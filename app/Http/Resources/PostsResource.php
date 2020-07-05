<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TagResource;
use Carbon\Carbon;
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
        // $carbon = new Carbon();
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
        'comments' => CommentResource::collection($this->getComment()),
        'tags' => TagResource::collection($this->tag),
        'created_at' => $this->created_at,
        'difference' => $this->created_at->diffForHumans()
        
        ];      
    }
}
