<?php

namespace App\Services\Transactions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WithdrawService
{
    public function withdraw(Request $request): JsonResponse
    {
        $user = User::find($request->input('user_id'));

        if ($user->balanceFloat < $request->input('amount')) {
            return response()->json(['message' => 'Недостатньо коштів на балансі'], 400);
        }

        $withdrawAmount = $request->input('amount');
        $user->withdrawFloat($withdrawAmount);

        return response()->json(['message' => 'Кошти виведено з балансу користувача'], 200);
    }
}
