<?php

namespace App\Http\Requests\Tour;

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
            'description_ru'=>'required|string|min:10',
            'description_uz'=>'required|string|min:10',
            'description_en'=>'required|string|min:10',
            'price'=>'required|numeric|min:1|max:99999999999999.99',
            'country_id'=>'required|exists:countries,id',
            'sale'=>'nullable|numeric|min:1|max:99',
            'is_active'=>'nullable|integer|in:0,1',
            'is_popular'=>'nullable|integer|in:0,1',
            'images_token'=>'required|array',
            'images_token.*'=>'required|string',
            'category'=>'required|array',
            'category.*'=>'required|integer|exists:categories,id'
        ];
    }
}
