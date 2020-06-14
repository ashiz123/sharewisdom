<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UploadProfilePictureResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => new UploadProfilePictureResource($this->userImage),
            'other' => new UserDetailResource($this->userDetail),
            'notifications' => $this->notifications
            
        ];
    }
}
