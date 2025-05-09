<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends AberitCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => PostResource::collection($this->collection),
            'meta' => $this->meta,
        ];
    }
}
