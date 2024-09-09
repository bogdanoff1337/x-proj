<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\DepositeRequest;
use App\Services\Transactions\DepositService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepositController extends Controller
{
    protected $depositService;

    public function __construct(DepositService $depositService)
    {
        $this->depositService = $depositService;
    }

    public function deposit(DepositeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->depositService->deposit($data);

        return response()->json(['message' => 'Баланс користувача поповнено'], 200);

    }
}
