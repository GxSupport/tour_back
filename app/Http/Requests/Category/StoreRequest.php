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
}
