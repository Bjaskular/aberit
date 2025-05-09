<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentFormRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Http\Services\Interfaces\ICommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function __construct(private readonly ICommentService $commentService){}

    public function index(): CommentCollection
    {
        $comments = $this->commentService->getPaginate();

        return new CommentCollection($comments);
    }

    public function all(): CommentCollection
    {
        $comments = Cache::remember('comments_all', 60, function () {
            return $this->commentService->getAll();
        });

        return new CommentCollection($comments);
    }

    public function show(int $id): CommentResource
    {
        $comment = $this->commentService->getById($id);

        return new CommentResource($comment);
    }

    public function store(CommentFormRequest $request): CommentResource
    {
        $comment = $this->commentService->store($request->validated());

        return new CommentResource($comment);
    }

    public function update(CommentFormRequest $request, int $id): CommentResource
    {
        $comment = $this->commentService->update($id, $request->validated());

        return new CommentResource($comment);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->commentService->delete($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
