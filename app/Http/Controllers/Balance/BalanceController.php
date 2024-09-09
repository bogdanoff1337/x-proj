<?php

namespace App\Http\Controllers\Balance;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Balance\BalanceService;

class BalanceController extends Controller
{
    protected $balanceService;

    public function __construct(BalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    public function getBalance(User $user): float
    {
        return $this->balanceService->getBalance($user);
    }
}
