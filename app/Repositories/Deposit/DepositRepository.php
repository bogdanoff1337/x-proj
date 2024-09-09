<?php

namespace App\Repositories\Deposit;

use App\Models\User;

class DepositRepository implements DepositRepositoryInterface
{
    public function deposit(array $data)
    {
        $user = User::query()->find($data['user_id']);

        return $user->deposit($data['amount']);
    }
}
