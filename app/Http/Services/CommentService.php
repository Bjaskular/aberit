<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\ICommentService;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService implements ICommentService
{
    public function __construct(private readonly Comment $comment){}

    public function getAll(): Collection
    {
        return $this->comment->query()->get();
    }

    public function getPaginate(): LengthAwarePaginator
    {
        return $this->comment->query()->paginate(10);
    }

    public function getById(int $id): Comment
    {
        return $this->comment->query()->findOrFail($id);
    }

    public function store(array $requestArray): Comment
    {
        $comment = clone $this->comment;

        $comment->fill($requestArray)->save();

        return $comment;
    }

    public function update(int $id, array $requestArray): Comment
    {
        $comment = $this->getById($id);

        $comment->update($requestArray);

        return $comment;
    }

    public function delete(int $id): Comment
    {
        $comment = $this->getById($id);

        $comment->delete();

        return $comment;
    }
}
