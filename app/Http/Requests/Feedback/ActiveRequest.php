<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class ActiveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'is_active'=>'required|integer|in:0,1'
        ];
    }

    public function bodyParameters():array
    {
        return [
            'is_active' => [
                'description' => 'gaplashilgan ariza bilan yangi arizani farqlash uchun(default-0, klient bilan gaplashilgan bo`lsa is_active-1 qilish kerak)',
                'example' => '1',
            ]
        ];
    }
}
