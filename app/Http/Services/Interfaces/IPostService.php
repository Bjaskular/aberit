<?php

namespace App\Http\Services\Interfaces;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPostService
{
    public function getAll(): Collection;
    public function getPaginate(): LengthAwarePaginator;
    public function getById(int $id): Post;
    public function store(array $requestArray): Post;
    public function update(int $id, array $requestArray): Post;
    public function delete(int $id): Post;
}
