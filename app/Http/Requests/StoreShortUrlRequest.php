<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'long_url' => 'required|max:255'
        ];
    }

    public function message(): array {
        return [
            'long_url.required' => 'The long URL is required.',
            'long_url.max' => 'The long URL must not exceed 255 characters.',
        ];
    }
}
