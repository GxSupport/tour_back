<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search'=>'nullable|string'
        ];
    }
    public function bodyParameters():array
    {
        return [
            'search' => [
                'description' => 'Izlash uchun key',
                'example' => 'nimadir',
            ]
        ];
    }
}
