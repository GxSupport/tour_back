<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ru'=>'required|string|min:2',
            'name_uz'=>'required|string|min:2',
            'name_en'=>'required|string|min:2',
            'description_ru'=>'required|string|min:10',
            'description_uz'=>'required|string|min:10',
            'description_en'=>'required|string|min:10',
            'price'=>'required|numeric|min:1|max:99999999999999.99',
            'country_id'=>'required|exists:categories,id',
            'sale'=>'nullable|numeric|min:1|max:99',
            'is_active'=>'nullable|integer|in:0,1',
            'is_popular'=>'nullable|integer|in:0,1',
            'images_token'=>'nullable|array',
            'images_token.*'=>'nullable|string',
            'category'=>'nullable|array',
            'category.*'=>'nullable|integer|exists:categories,id'
        ];
    }

    public function bodyParameters():array
    {
        return [
            'name_ru' => [
                'description' => 'Tour nomi RU',
                'example' => 'Yozgi',
            ],
            'name_uz' => [
                'description' => 'Tour nomi UZ',
                'example' => 'Yozgi',
            ],
            'name_en' => [
                'description' => 'Tour nomi EN',
                'example' => 'Yozgi',
            ],
            'description_uz' => [
                'description' => 'tavsif UZ',
                'example' => 'istalgan matn',
            ],
            'description_ru' => [
                'description' => 'tavsif RU',
                'example' => 'istalgan matn',
            ],
            'description_en' => [
                'description' => 'tavsif EN',
                'example' => 'istalgan matn',
            ],
            'price' => [
                'description' => 'narxi',
                'example' => '4587884',
            ],
            'country_id' => [
                'description' => 'Country id si',
                'example' => '1',
            ],
            'sale' => [
                'description' => 'Skidka 15% bo`lsa faqat 15 yuboriladi',
                'example' => '15',
            ],
            'is_active' => [
                'description' => 'Aktivligi (1-aktiv,0-aktiv emas,default-0)',
                'example' => '1',
            ],
            'is_popular' => [
                'description' => 'Popularligi (1-popular,0-popular emas,default-0)',
                'example' => '1',
            ],
            'images_token' => [
                'description' => 'rasmni tokeni array',
                'example' => ["loijkdwdaijUSnm","BYSunaji78hcdwa"],
            ],
            'category' => [
                'description' => 'Categorylar id si array',
                'example' => [1,2,3,5],
            ]
        ];
    }
}
