<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240'
        ];
    }
}
