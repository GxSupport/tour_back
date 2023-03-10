<?php

namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'key'=>'required|string',
            'name_ru'=>'required|string',
            'name_uz'=>'required|string',
            'name_en'=>'required|string',
        ];
    }
    public function bodyParameters():array
    {
        return [
            'key' => [
                'description' => 'Saytgadi asosiy ma`lumotlarni saqlab turish uchun istalgan key',
                'example' => 'phone',
            ],
            'name_ru' => [
                'description' => 'keyni qiymati RU',
                'example' => '+998945890598',
            ],
            'name_uz' => [
                'description' => 'keyni qiymati UZ',
                'example' => '+998945890598',
            ],
            'name_en' => [
                'description' => 'keyni qiymati EN',
                'example' => '+998945890598',
            ]
        ];
    }
}
