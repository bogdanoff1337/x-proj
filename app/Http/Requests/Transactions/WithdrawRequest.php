<?php

namespace App\Http\Requests\Transactions;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'amount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Поле сума обов\'язкове',
            'amount.numeric' => 'Поле сума повинно бути числом',
        ];
    }
}
