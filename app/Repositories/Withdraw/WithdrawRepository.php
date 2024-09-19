<?php

namespace App\Repositories\Withdraw;

use App\Models\User;

class WithdrawRepository implements WithdrawRepositoryInterface
{
    public function withdraw(array $data, User $user)
    {
        $user->withdrawFloat($data['amount']);
    }
}
