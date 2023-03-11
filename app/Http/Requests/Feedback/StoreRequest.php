<?php

namespace App\Http\Requests\Feedback;

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
            'phone'=>'required|string|min:12|max:13',
            'first_name'=>'required|string|min:2',
            'last_name'=>'required|string|min:2',
            'comment'=>'required|string|min:2'
        ];
    }

    public function bodyParameters():array
    {
        return [
            'phone' => [
                'description' => 'telefon',
                'example' => '+998945890598',
            ],
            'first_name' => [
                'description' => 'ism',
                'example' => 'ibrohim',
            ],
            'last_name' => [
                'description' => 'familiya',
                'example' => 'xolboyev',
            ],
            'comment' => [
                'description' => 'qayerga bormoqchi nima qilmoqchi',
                'example' => 'istalgan text',
            ]
        ];
    }
}
