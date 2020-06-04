<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserFollowRepositoryInterface;
use App\Models\User;
use App\Helpers\Following;
use App\Models\FollowUser;

class UserFollowRepository implements UserFollowRepositoryInterface
{
    public function followUser($leaderId, $followerId)
    {
            $currentUser = User::find($followerId);
            if(! $currentUser) {
            
            //if no user in table.
        }
        $currentUser->followings()->attach($leaderId);
        return ($currentUser->followings());
    }


    public function unFollowUser($leaderId, $followerId)
    {
            $currentUser = User::find($followerId);
            if(! $currentUser) {
                
                //error message if no user
            }
            $currentUser->followings()->detach($leaderId);
            return ([]);
    } 

    public function checkUserFollow($leaderId, $followerId)
    {
        $currentUser = FollowUser::where('follow_id', $followerId)->get();
        
        $followUsers = $currentUser->filter(function($followUser) use ($leaderId){
            return $followUser->leader_id == $leaderId;
        });


        return ($followUsers);

    }

}

