<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Services\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private readonly IUserService $userService){}

    public function index(): UserCollection
    {
        $users = $this->userService->getPaginate();

        return new UserCollection($users);
    }

    public function all(): UserCollection
    {
        $users = Cache::remember('users_all', 60, function () {
            return $this->userService->getAll();
        });

        return new UserCollection($users);
    }

    public function show(int $id): UserResource
    {
        $user = $this->userService->getById($id);

        return new UserResource($user);
    }

    public function store(UserFormRequest $request): UserResource
    {
        $user = $this->userService->store($request->validated());

        return new UserResource($user);
    }

    public function update(UserFormRequest $request, int $id): UserResource
    {
        $user = $this->userService->update($id, $request->validated());

        return new UserResource($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
