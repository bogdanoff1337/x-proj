<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'trade_url' => 'required|url',
        ];
    }

    public function messages(): array
    {
        return [
            'trade_url.required' => 'Trade URL is required',
            'trade_url.url' => 'Trade URL must be a valid URL',
        ];
    }
}
