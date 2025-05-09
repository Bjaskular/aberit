<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\IPostService;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService implements IPostService
{
    public function __construct(private readonly Post $post){}

    public function getAll(): Collection
    {
        return $this->post->query()->get();
    }

    public function getPaginate(): LengthAwarePaginator
    {
        return $this->post->query()->paginate(10);
    }

    public function getById(int $id): Post
    {
        return $this->post->query()->findOrFail($id);
    }

    public function store(array $requestArray): Post
    {
        $post = clone $this->post;

        $post->fill($requestArray)->save();

        return $post;
    }

    public function update(int $id, array $requestArray): Post
    {
        $post = $this->getById($id);

        $post->update($requestArray);

        return $post;
    }

    public function delete(int $id): Post
    {
        $post = $this->getById($id);

        $post->delete();

        return $post;
    }
}
