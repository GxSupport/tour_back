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
}
