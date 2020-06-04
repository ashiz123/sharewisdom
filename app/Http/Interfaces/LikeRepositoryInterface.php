<?php

namespace App\Http\Interfaces;


interface LikeRepositoryInterface
{
    public function like($attribute);
    
    public function unLike($likeId);

    public function likeStatus($likeId, $postId);
}