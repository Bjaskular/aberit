<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends AberitCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => CommentResource::collection($this->collection),
            'meta' => $this->meta,
        ];
    }
}
