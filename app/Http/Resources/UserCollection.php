<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends AberitCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => UserResource::collection($this->collection),
            'meta' => $this->meta,
        ];
    }
}
