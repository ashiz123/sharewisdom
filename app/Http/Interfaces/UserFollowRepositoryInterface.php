<?php

namespace App\Http\Interfaces;

interface UserFollowRepositoryInterface
{
    public function followUser($leaderId, $followerId);

    public function unFollowUser($leaderId, $followerId);

    public function checkUserFollow($leaderId, $followerId);
}