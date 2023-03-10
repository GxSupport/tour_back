<?php

namespace App\Http\Requests\Country;

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
                'description' => 'country nomi RU',
                'example' => 'Asia',
            ],
            'name_uz' => [
                'description' => 'country nomi UZ',
                'example' => 'Asia',
            ],
            'name_en' => [
                'description' => 'country nomi EN',
                'example' => 'Asia',
            ],
            'is_active' => [
                'description' => 'activligi (default-0,1-aktiv,0-aktiv emas)',
                'example' => '1',
            ]
        ];
    }
}
