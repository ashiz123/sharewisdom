<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostsResource;
use App\Http\Interfaces\PostRepositoryInterface;
use App\Models\User;
use App\Models\Tag;
use App\Helpers\Paginate;


class PostController extends Controller
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
         $this->postRepository = $postRepository;   
    }

    public function createPost(Request $request)
    {
        $data = $this->postRepository->createPost($request);
        return response()->json($data);
    }


    public function userPosts($id)
    {
        $user = User::find($id);
        $userPosts = $this->postRepository->userPosts($user);
        return  PostsResource::collection($userPosts);  
              
    }

    public function allPosts()
    {
        $allPosts = $this->postRepository->allPosts();
        return PostsResource::collection($allPosts);  
    }


    public function tagPosts($name)
    {
        $tag = Tag::where('title', $name)->first(); 
        $tagPosts = $this->postRepository->tagPosts($tag);
        return  PostsResource::collection($tagPosts);
    }


    public function postDetail($id)
    {
        $repo = $this->postRepository->postDetail($id);
        $detail =  new PostsResource($repo);
        return response()->json($detail);
    }


    public function getFollowedUserPost($id)
    {
        $repo = $this->postRepository->getFollowedUserPost($id);
        $resource = PostsResource::collection($repo);
        return response()->json($resource);
    }


    public function getAuthUserFollowedPosts($id)
    {
        $repo = $this->postRepository->authUserFollowedPosts($id);
        $resource = PostsResource::collection($repo);
        $data = Paginate::paginate($resource); //manually creating paginate
        return response()->json($data);
    }



    
    
}
