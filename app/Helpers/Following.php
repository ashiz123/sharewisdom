<?php

namespace App\Helpers;
use App\Followers;
use Auth;

 class Following
{
    public static function follow($profileId)
      {
        $followers = Followers::where('follower_id', Auth::user()->id)->get();
        
        if($followers->count() > 0) {
            foreach($followers as $follower)
            {
             
                if((int)$follower->leader_id == (int)$profileId)
                {
                   
                    return true;
                }
               
            }
                return false;
       
      }
      return false;
      }
}