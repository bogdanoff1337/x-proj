<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\WithdrawService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WithdrawController extends Controller
{
    protected $withdrawService;

    public function __construct(WithdrawService $withdrawService)
    {
        $this->withdrawService = $withdrawService;
    }

    public function withdraw(Request $request): JsonResponse
    {
        return $this->withdrawService->withdraw($request);
    }
}
