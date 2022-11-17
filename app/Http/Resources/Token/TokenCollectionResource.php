<?php

namespace App\Http\Resources\Token;

use App\Http\Resources\BaseJsonCollectionResource;

class TokenCollectionResource extends BaseJsonCollectionResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = TokenResource::class;
}
