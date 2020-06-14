<?php

namespace App\Http\Interfaces;
use App\Models\User;
use App\Models\Tag;


interface PostRepositoryInterface
{
    public function userPosts(User $user);

    public function allPosts();

    public function tagPosts(Tag $tag);

    public function createPost($attributes);

    public function postDetail($id);

    public function getFollowedUserPost($id);

    public function authUserFollowedPosts($id);
    


    
}