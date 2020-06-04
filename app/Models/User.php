<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Tag;
use App\Models\UserTag;
use App\Models\Post;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tagRelation(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, UserTag::class);
    }

    public function tags()
    {
        return $this->tagRelation();
    }

    public function postRelation(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id' );
    }

    public function posts()
    {
        return $this->postRelation()->latest();
    }


    public function userDetailRelation(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function userDetail()
    {
        return $this->userDetailRelation();
    }

    public function userImageRelation(): HasOne{
        return $this->hasOne(UserImage::class);
    }


    public function userImage()
    {
        return $this->userImageRelation();
    }

    public function followers(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'follow_users', 'leader_id', 'follow_id')->withTimestamps();
}

/**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function followings(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'follow_users', 'follow_id', 'leader_id')->withTimestamps();
}

public function likeOrNot($postId)
{
    $likes = Like::where('like_id', $this->id)->get();
    $filterLikes = $likes->filter(function($like) use($postId){
        if($like->post_id == $postId)
        {
            return true;
        }else{
            return false;
        }

    });
    return $filterLikes;
}






}
