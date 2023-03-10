<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'refresh_token'=>'required|string'
        ];
    }
    public function bodyParameters():array
    {
        return [
            'refresh_token' => [
                'description' => 'refresh token',
                'example' => 'AiOiJKV1QiLCJhbGciOiJSUzI1NiJ9'
            ]
        ];
    }
}
