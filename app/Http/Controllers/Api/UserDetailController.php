<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\UserDetailRepositoryInterface;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UploadProfilePictureResource;
use DB;

class UserDetailController extends Controller
{
    private $userDetailRepoInterface;

    public function __construct(UserDetailRepositoryInterface $userDetailRepoInterface)
    {
        $this->userDetailRepoInterface = $userDetailRepoInterface;
    }


    public function store(Request $request, $userId)
    {   
        $user = User::find($userId);
        $userDetail = $this->userDetailRepoInterface->storeUserDetail($request, $user);
        $data = new UserDetailResource($userDetail);
        return response()->json($data);

    }
    
    
    public function uploadProfilePicture(Request $request, $userId)
    {
        $uploadImage = $this->userDetailRepoInterface->uploadProfilePicture($request->image, $userId);
        $image =  new UploadProfilePictureResource($uploadImage);
        return response()->json($image);
    }
}
