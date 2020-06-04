<?php

namespace App\Http\Resources;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => TagResource::collection($this->collection),
            'meta' => ['tag_count' => $this->collection->count()],
        ];
    }
}


