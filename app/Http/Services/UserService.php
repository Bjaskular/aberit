<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\IUserService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements IUserService
{
    public function __construct(private readonly User $user){}

    public function getAll(): Collection
    {
        return $this->user->query()->all();
    }

    public function getPaginate(): LengthAwarePaginator
    {
        return $this->user->query()->paginate(10);
    }

    public function getById(int $id): User
    {
        return $this->user->query()->findOrFail($id);
    }

    public function store(array $requestArray): User
    {
        $user = clone $this->user;

        $user->fill($requestArray)->save();

        return $user;
    }

    public function update(int $id, array $requestArray): User
    {
        $user = $this->getById($id);

        $user->update($requestArray);

        return $user;
    }

    public function delete(int $id): User
    {
        $user = $this->getById($id);

        $user->delete();

        return $user;
    }
}
