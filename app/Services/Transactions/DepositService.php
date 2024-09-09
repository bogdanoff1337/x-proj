<?php

namespace App\Services\Transactions;

use App\Repositories\Deposit\DepositRepositoryInterface;

class DepositService
{
    public function __construct(
        protected DepositRepositoryInterface $balanceRepositoryInterface
    ) {
    }

    public function deposit(array $data): void
    {
        $this->balanceRepositoryInterface->deposit($data);
    }
}
