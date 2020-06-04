<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\LikeRepositoryInterface;
use App\Http\Resources\LikeResource;

class LikeController extends Controller
{

    private $likeRepo;

    public function __construct(LikeRepositoryInterface $likeRepo)
    {
        $this->likeRepo = $likeRepo;
    }


    public function like(Request $request)
    {
      
        $likeable = $this->likeRepo->like($request);
        // $resource = new LikeResource($likeable);
        return response()->json($likeable);
    }


    public function unLike($likeId)
    {
        $unlikeable = $this->likeRepo->unlike($likeId);
        return response()->json($unlikeable);
    }

    public function getLikeStatus($likeId, $postId)
    {
        $getLikeStatus = $this->likeRepo->likeStatus($likeId, $postId);
        return response()->json($getLikeStatus);
    }
}
