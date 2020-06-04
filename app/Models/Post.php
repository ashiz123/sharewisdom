<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Tag;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{

    protected $guarded = [];

    protected $table = 'posts';

    public function tagRelation(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function tag()
    {
        return $this->tagRelation();
    }


    public function userRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function user()
    {
        return $this->userRelation();
    }

    public function likeCount($userId)
    {
        $likePosts = Like::where('post_id', $this->id)->get();
        $like = $likePosts->filter(function($likePost) use($userId){
            if($likePost->like_id == $userId)
            {
                return $likePost  ;
            }
         
        });

        return $like->count();
    }

    

    public function likeRelation(): HasMany
    {
        return $this->hasMany(Like::class, 'like_id' );
    }


    public function like()
    {
        return $this->likeRelation();
    }


    public function getLikeCount()
    {
        $post = Like::where('post_id', $this->id)->get();
        return $post->count();
    }


    public function getComment()
    {
        $comments = Comment::where('post_id', $this->id)->get();
        return $comments;
    }

    public function commentCount()
    {
       return $this->getComment()->count();
    }


    

    


}
