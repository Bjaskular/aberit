<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class AberitCollection extends ResourceCollection
{
    protected $meta = [];

    public function __construct($resource)
    {
        if ($resource instanceof LengthAwarePaginator) {
            $this->meta = array_merge([
                'last_page' => $resource->lastPage(),
                'per_page' => $resource->perPage(),
                'page' => $resource->currentPage(),
                'total' => $resource->total(),
            ]);

            $resource = $resource->getCollection();
        }

        parent::__construct($resource);
    }
}
