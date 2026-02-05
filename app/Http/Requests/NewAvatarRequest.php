<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAvatarRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [
            'profile_image' => ['required', 'image','mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ];
    }
}
