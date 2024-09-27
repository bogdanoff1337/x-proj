<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
    ){
    }

    public function update(UserRequest $request)
    {
        $data = $request->validated();
        $this->userService->update($data);

        return response()->json(['message' => 'User updated successfully']);
    }
}
