<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\TagRepositoryInterface;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagCollection;
use App\Models\User;

use App\Models\Tag;


class TagController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    public function getAllTags()
    {
        $allTags = $this->tagRepository->getAllTags();
        return new TagCollection($allTags);
    }   


    public function userTags($id)
    {
        $user = User::find($id);
        $userTags = $this->tagRepository->userTags($user);
        return  new TagCollection($userTags);
    }


    public function subscribeTag(Request $request, $id)
    {
        $userTags = $this->tagRepository->subscribeTag($request,$id);
        $data =  new TagResource($userTags);
        return response()->json($data);
    }


    // public function getUnsubscribeTags()
    // {

    // }
}
