<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function update(array $data)
    {
        $user = User::query()->find($data['user_id']);

        return $user->update($data);
    }
}
