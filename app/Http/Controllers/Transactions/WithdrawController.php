<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\WithdrawRequest;
use App\Models\User;
use App\Services\Transactions\WithdrawService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WithdrawController extends Controller
{
    public function __construct(
        protected WithdrawService $withdrawService
    ){
    }

    public function withdraw(WithdrawRequest $request): JsonResponse
    {
        $user = User::query()->find($request->user_id);
        $data = $request->validated();

        if ($user->balance < $data['amount']) {
            return response()->json(['message' => 'Недостатньо коштів на балансі'], 400);
        }

        $this->withdrawService->withdraw($data, $user);

        return response()->json(['message' => 'Кошти успішно виведено'], 200);
    }
}
