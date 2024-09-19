<?php

namespace App\Repositories\Balance;

use App\Models\User;

class BalanceRepository implements BalanceRepositoryInterface
{
    public function getBalance(User $user): float
    {
        return $user->balanceFloat;
    }
}
