<?php

namespace App\Repositories\Withdraw;

use App\Models\User;

interface WithdrawRepositoryInterface
{
    public function withdraw(array $data, User $user);
}
