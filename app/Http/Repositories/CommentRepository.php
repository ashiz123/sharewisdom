<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function createComment($attribute, $postId)
    {
        
      $comment = new Comment();
      $comment->post_id = $postId;
      $comment->comment = $attribute->comment;
      $comment->user_id = $attribute->user_id;
      if($comment->save())
      {
          return $comment;
      }
    }

    public function removeComment($postId)
    {

    }
}
