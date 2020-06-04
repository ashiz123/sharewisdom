<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table= 'likes';

    protected $fillable = ['like_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }




}
