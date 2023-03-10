<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'name_ru'=>'required|string|min:2',
            'name_uz'=>'required|string|min:2',
            'name_en'=>'required|string|min:2',
            'is_active'=>'nullable|in:0,1'
        ];
    }
    public function bodyParameters():array
    {
        return [
            'name_ru' => [
                'description' => 'name RU',
                'example' => 'Uzbekistan',
            ],
            'name_uz' => [
                'description' => 'name UZ',
                'example' => 'Uzbekistan',
            ],
            'name_en' => [
                'description' => 'name EN',
                'example' => 'Uzbekistan',
            ],
            'is_active' => [
                'description' => 'Aktivligi(1-aktiv,0-aktiv emas,default-0)',
                'example' => '1',
            ]
        ];
    }
}
