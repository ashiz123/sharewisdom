<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

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

  
}
