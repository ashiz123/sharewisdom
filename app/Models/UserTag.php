<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Tag;

class UserTag extends Model
{

    protected $table = "user_tags";

    protected $fillable = ['user_id', 'tag_id'];

    

    // public function tagId()
    // {
    //    return Tag::find($this->tag_id);
    // }
}
