<?php

namespace App\Http\Services\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserService
{
    public function getAll(): Collection;
    public function getPaginate(): LengthAwarePaginator;
    public function getById(int $id): User;
    public function store(array $requestArray): User;
    public function update(int $id, array $requestArray): User;
    public function delete(int $id): User;
}
