<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UploadProfilePictureResource;

class UserNameAndImageResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'image' => new UploadProfilePictureResource($this->userImage),
            
        ];
    }
}
