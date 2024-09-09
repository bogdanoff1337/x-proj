<?php

namespace App\Repositories\Balance;

use App\Models\User;

interface BalanceRepositoryInterface
{
    public function getBalance(User $user): float;
}
