<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Post;
use App\Models\PostTag;

class Tag extends Model
{

    protected $table = 'tags';

    protected $fillable = ['title'];


    public function userRelation(): BelongsToMany
    {   
        return $this->belongsToMany(User::class);
    }

    public function users()
    {
        return $this->userRelation();
    }


    public function postRelation(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, PostTag::class) ;
    }

    public function posts()
    {
        return $this->postRelation()->latest();
    }


    
  

    

  
}
