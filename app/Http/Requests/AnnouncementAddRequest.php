<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnouncementAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule', 'array<mixed>', 'string>
     */
    public function rules(): array
    {
        return [
            'title_en' => [ 'required', 'string', 'max:255' ],
            'title_nl' => [ 'required', 'string', 'max:255' ],
            'date' => [ 'required', Rule::date()->format('Y-m-d') ],
            'content_en' => [ 'required', 'string' ],
            'content_nl' => [ 'required', 'string' ],
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }

    public function withValidator($validator)
    {
        $validator->validateWithBag('announcement');
    }   
}
