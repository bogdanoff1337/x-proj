<?php

namespace App\Services\Transactions;

use App\Models\User;
use App\Repositories\Withdraw\WithdrawRepository;
use Illuminate\Http\JsonResponse;

class WithdrawService
{
    public function __construct(
        protected WithdrawRepository $withdrawRepository
    ) {
    }

    public function withdraw(array $data, User $user): void
    {
        $this->withdrawRepository->withdraw($data, $user);
    }
}
