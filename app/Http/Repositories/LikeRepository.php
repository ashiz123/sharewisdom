<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\LikeRepositoryInterface;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;

class LikeRepository implements LikeRepositoryInterface
{
    public function like($attribute)
    {
        $likeCount = Post::find($attribute->post_id)->likeCount($attribute->like_id);
      
        if($likeCount < 1)
        {
            $like = new Like();
            $like->create([
                'like_id' => $attribute->like_id,
                'post_id' => $attribute->post_id
            ]);
            return 'like';
        }else{
            Like::where('like_id', $attribute->like_id)->where('post_id', $attribute->post_id)->delete();
            return 'unlike';
        }
     

     
        
    }


    public function unLike($likeId)
    {
       Like::where('like_id', $likeId)->delete();
       return 'unlike success';
    }



    public function likeStatus($likeId, $postId)
    {
        $likeOrNot = User::find($likeId)->likeOrNot($postId);
        return $likeOrNot;
    }




   
}



