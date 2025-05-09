<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Services\Interfaces\IPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(private readonly IPostService $postService){}

    public function index(): PostCollection
    {
        $posts = $this->postService->getPaginate();

        return new PostCollection($posts);
    }

    public function all(): PostCollection
    {
        $posts = Cache::remember('posts_all', 60, function () {
            return $this->postService->getAll();
        });

        return new PostCollection($posts);
    }

    public function show(int $id): PostResource
    {
        $post = $this->postService->getById($id);

        return new PostResource($post);
    }

    public function store(PostFormRequest $request): PostResource
    {
        $post = $this->postService->store($request->validated());

        return new PostResource($post);
    }

    public function update(PostFormRequest $request, int $id): PostResource
    {
        $post = $this->postService->update($id, $request->validated());

        return new PostResource($post);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->postService->delete($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
