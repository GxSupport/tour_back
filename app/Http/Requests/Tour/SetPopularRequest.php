<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $is_popular
 */
class SetPopularRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'is_popular'=>'required|integer|in:0,1'
        ];
    }
}
