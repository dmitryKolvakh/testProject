<?php

namespace App\Http\Resources\Token;

use App\Http\Resources\Tag\TagCollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'tags' => new TagCollectionResource($this->tags)
        ];
    }
}
