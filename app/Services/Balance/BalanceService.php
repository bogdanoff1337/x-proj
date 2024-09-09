<?php

namespace App\Services\Balance;

use App\Models\User;
use App\Repositories\Balance\BalanceRepositoryInterface;

class BalanceService
{
    public function __construct(
        protected BalanceRepositoryInterface  $balanceRepositoryInterface
    ) {
    }

    public function getBalance(User $user): float
    {
        return $this->balanceRepositoryInterface->getBalance($user);
    }
}
