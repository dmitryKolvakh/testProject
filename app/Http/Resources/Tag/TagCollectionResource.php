<?php

namespace App\Http\Resources\Tag;

use App\Http\Resources\BaseJsonCollectionResource;

class TagCollectionResource extends BaseJsonCollectionResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = TagResource::class;
}
