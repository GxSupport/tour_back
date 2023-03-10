<?php

namespace App\Http\Requests\Tour;

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
            'country_id'=>'nullable|exists:countries,id',
            'sale'=>'nullable|in:1',
            'category_id'=>'nullable|exists:categories,id'
        ];
    }

    public function bodyParameters():array
    {
        return [
            'country_id' => [
                'description' => 'Country ni id si',
                'example' => '1',
            ],
            'sale' => [
                'description' => 'Chegirmadagilarni olish(1-chegirmadagilarni olish,yuborilmasa hammasini oladi)',
                'example' => '1',
            ]
        ];
    }
}
