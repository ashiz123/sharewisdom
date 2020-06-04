<?php

namespace App\Http\Interfaces;

interface CommentRepositoryInterface
{
    public function createComment($attribute, $postId);

    public function removeComment($postId);





}