<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = ['user_id', 'image', 'mobile_number', 'address', 'country', 'postal_code', 'about_me', 'designation'];

    public function userRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function user()
    {
        return $this->userRelation();
    }



}
