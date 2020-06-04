<?php


namespace App\Http\Interfaces;
use App\Models\User;

interface TagRepositoryInterface 
{
    public function userTags(User $user);

    public function getAllTags();

    public function deleteTags();

    public function subscribeTag($attribute, $userId);

}