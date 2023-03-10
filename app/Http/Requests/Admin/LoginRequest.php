<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'email'=>'required|string',
            'password'=>'required|string|min:6',
        ];
    }

    public function bodyParameters():array
    {
        return [
            'email' => [
                'description' => 'Email',
                'example' => 'admin@admin.com',
            ],
            'password' => [
                'description' => 'Parol',
                'example' => '123456',
            ]
        ];
    }
}
