<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\PostRepositoryInterface;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\PostTag;
use App\Http\Traits\FileUploadTraits;
use DB;

class PostRepository implements PostRepositoryInterface
{


    public $path = "posts/";

    use FileUploadTraits;
    
    public function userPosts(User $user)
    {
        return $user->posts;
    }


    public function allPosts()
    {
        return Post::latest()->take(6)->get();
    }

    public function tagPosts(Tag $tag)
    {
        return $tag->posts;
    }



    public function createPost($attributes)
    {
    try{
            $post = new Post;
            $post->title = $attributes['title'];
            $post->description = $attributes['description'];
            $post->links = $attributes['link'];
            $post->author = $attributes['author'];
            $post->image = $this->uploadImage( $attributes['image'], $this->path);
             if($attributes['publish'] == 'true')
            {
                $publish = 1;
            }else{
                $publish = 0;
            }
            $post->publish = $publish;
            $post->user_id = $attributes['user_id'];
             
              if($post->save()){
                //posting tag to tag table 
                $tags = $attributes['tags'];
                //getting tags in string and converting string to tags.
                $tags_ar = explode(',', $tags);
                $post->tag()->sync($tags_ar);
                DB::commit();
              
                }

          
        }


        catch(\Exception $e){
            DB::rollback();
        }
       return $post;
    }


    
    // $filtered = $collection->filter(function ($value, $key) {
    //     return $value > 2;
    // });

    public function postDetail($id)
    {
        $post = Post::find($id);
        return $post;
    }



    
    public function getFollowedUserPost($id)
    {
        $user = User::find($id);
        $followings = $user->followings->pluck('id');
        
       

        $posts = Post::latest()->get();
        $filtered = $posts->filter(function($post, $key) use($followings){
            foreach($followings as $following)
            {
                if( $post->user_id == $following)
                {
                    return $following;
                }
            }
          
        });

        return $filtered;
        // return $user->followings->
    }


    public function authUserFollowedPosts($id)
    {
        $user = User::find($id);
        $following = $user->followings->pluck('id');
        $user = collect($user->id);
        $collection = collect([$following, $user]);
        $currentUserWithFollowings  = $collection->collapse();
        
        $posts = Post::latest()->get();
        $filtered = $posts->filter(function($post, $key) use($currentUserWithFollowings){
            foreach($currentUserWithFollowings as $user)
            {
                
                if( $post->user_id == $user)
                {
                    return $user;
                }
            }
          
        });

        return $filtered;
        
    }

}