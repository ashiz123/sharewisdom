<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\TagRepositoryInterface;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;

class TagRepository implements TagRepositoryInterface
{

    public function userTags(User $user)
    {
        $tags = User::find($user->id)->tags;  
        return $tags;      
    }

    public function getAllTags(){
        $tags = Tag::all();
        return $tags;
    }



    public function deleteTags(){

    }



    public function subscribeTag($attribute, $userId)
    {
       $tag_id = $attribute->tag_id;
       
        $userTagsExist = UserTag::where('user_id', $userId)->exists();
        if($userTagsExist == true)
        {
            $userTags = User::find($userId)->tags;
            $filter = $userTags->filter(function($userTag) use($tag_id){
                return $userTag->id == $tag_id;
            });
            if (count($filter) == 0)
            {
                         $user = User::find($userId);
                        $tagId = $attribute->tag_id;
                         $user->tags()->attach($tagId);

                         return Tag::find($tagId);
                        //  return 'successfully_created';
                        
                        
            }else{
                return 'already_created';
            }
        }else{
            
            $user = User::find($userId);
            $tagId = $attribute->tag_id;
             $user->tags()->attach($tagId);
             return Tag::find($tagId);
        }
    }

    



    // public function subscribeTag($attribute, $userId)
    // {
       
    //     $tag_id = $attribute->tag_id;
    //     $count = 0;
    //     $userTagsExist = UserTag::where('user_id', $userId)->exists();
    //     if($userTagsExist == true)
    //     {
    //         $userTags = UserTag::where('user_id', $userId)->get();
    //         dd($userTags);
    //         $filterData = $userTags->filter(function($userTag) use($tag_id, $count){
    //           return $userTag->users();
    //         });
    //         return $filterData;
    //     //    if (count($filterData) < 1)
    //     //    {    
    //     //     $user = User::find($userId);
    //     //     $tagId = $attribute->tag_id;
    //     //     return $user->tags()->attach($tagId);
    //     //   }
    //     }else{
    //         $user = User::find($userId);
    //         $tagId = $attribute->tag_id;
    //         return $user->tags()->attach($tagId);
    //     }
    
       
    }


    // public function subscribeTag($attribute, $userId)
    // {
    //     $tagId = $attribute->tag_id;

    //     $userTags = UserTag::where('user_id', $userId)->get();
    //     // return $userTags;
    //     if(isset($userTags))
    //     {
    //         return 'empty';
    //     }else{
    //         return 'non empty';
    //     }

    //     // If($userTags != []){
    //     // $filterUserTag = $userTags->filter(function($userTag) use($tagId){
    //     //     if($userTag->tag_id != $tagId)
    //     //     {
    //     //         return 'tst';
    //     //     }

    //     // });
    //     // return 'test 1';
    //     // }


    //     return $userTags;

    //     $userTag =  new UserTag();
    //             $userTag->create([
    //                 'user_id' => $userId,
    //                 'tag_id' => $tagId
    //             ]);
          
    // }

