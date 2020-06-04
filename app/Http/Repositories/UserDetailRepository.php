<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\UserDetailRepositoryInterface;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserImage;
use Illuminate\Http\Request;
use App\Http\Traits\FileUploadTraits;
use DB;




class UserDetailRepository implements UserDetailRepositoryInterface
{

    public $path = "profile/";

    use FileUploadTraits;

    public function storeUserDetail(Request $request, User $user)
    {
        if(UserDetail::where('user_id', $user->id)->exists())
        {
            $userDetail = UserDetail::where('user_id', $user->id)->update($request->all());
        }
        else
        {

            $userDetail = UserDetail::create([
                'user_id' => $user->id,
                'country' => $request->input('country'),
                'address' => $request->input('address'),
                'mobile_number' => $request->input('mobile_number'),
                'postal_code' => $request->input('postal_code'),
                'designation' => $request->input('designation'),
                'about_me' => $request->input('about_me')
                ]);

        }
        $userDetail = $user->userDetail;
        return $userDetail;
        
    }


    public function uploadProfilePicture($image, $userId)
    {
        if(UserImage::where('user_id', $userId)->exists())
        {
            $userDetail = UserImage::where('user_id', $userId)->update([
                'image' =>  $this->uploadImage( $image, $this->path)
            ]);
           
        }
        else{
            $userDetail = UserImage::create([
                'user_id' => $userId,
                'image' =>  $this->uploadImage( $image, $this->path)
            ]);
        }

        $user = User::find($userId);
        return $user->userImage;
     }
    


   



}

