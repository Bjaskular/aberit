<?php

namespace App\Http\Services\Interfaces;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICommentService
{
    public function getAll(): Collection;
    public function getPaginate(): LengthAwarePaginator;
    public function getById(int $id): Comment;
    public function store(array $requestArray): Comment;
    public function update(int $id, array $requestArray): Comment;
    public function delete(int $id): Comment;
}
