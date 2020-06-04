<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\UserFollowRepositoryInterface;
use App\Http\Resources\checkUserFollow;

class UserFollowController extends Controller
{

    private $repo;

    public function __construct(UserFollowRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }


    public function followUser($leaderId, $followerId)
    {
        $follow = $this->repo->followUser($leaderId, $followerId);
     
        return response()->json($follow);
    }

    public function unfollowUser($leaderId, $followerId)
    {
        $unfollow = $this->repo->unFollowUser($leaderId, $followerId);
        $unfollowUser= new checkUserFollow($unfollow);
        return response()->json($unfollowUser);
    }


    //use case of filter function .
    public function checkUserFollow($leaderId, $followerId)
    {
        $checkFollow = $this->repo->checkUserFollow($leaderId, $followerId);
        $check= new checkUserFollow($checkFollow);
        return response()->json($check);
       
        // return response()->json($checkFollow);
       
    }
}
