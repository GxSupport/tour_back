<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'search'=>'nullable|string'
        ];
    }

    public function bodyParameters():array
    {
        return [
            'search' => [
                'description' => 'Izlash uchun nimadir',
                'example' => 'admin',
            ]
        ];
    }
}
