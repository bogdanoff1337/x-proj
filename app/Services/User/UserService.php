<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ){
    }

    public function update(array $data)
    {
        return $this->userRepository->update($data);
    }
}
