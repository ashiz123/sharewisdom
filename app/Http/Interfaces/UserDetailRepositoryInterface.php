<?php

namespace App\Http\Interfaces;
use App\Models\User;
use Illuminate\Http\Request;

interface UserDetailRepositoryInterface
{
    public function storeUserDetail(Request $request, User $user);

    public function uploadProfilePicture($image, $userId);
    
}