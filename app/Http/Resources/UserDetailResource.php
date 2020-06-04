<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            'address' => $this->address,
            'country' => $this->country,
            'mobile_number' => $this->mobile_number,
            'postal_code' => $this->postal_code,
            'designation' => $this->designation,
            'about_me' => $this->about_me
        ];
    }

}