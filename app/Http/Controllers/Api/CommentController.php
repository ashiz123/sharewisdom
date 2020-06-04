<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
// use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    private $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepo = $commentRepository;


    }

    public function createComment(Request $request, $postId)
    {   
        
        $repo = $this->commentRepo->createComment($request, $postId);
        $commentResource = new CommentResource($repo);
        return response()->json($commentResource);

    }

    public function editComment($postId)
    {

    }

    public function deleteComment($postId)
    {

    }

}
