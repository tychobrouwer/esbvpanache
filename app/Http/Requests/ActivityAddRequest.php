<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivityAddRequest extends FormRequest
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
            'date' => [ 'required', Rule::date()->format('d-m-Y H:i') ],
            'duration' => [ 'nullable', 'digits_between:0,1,numeric', 'min:0' ],
            'location_en' => [ 'required', 'string', 'max:255' ],
            'location_nl' => [ 'required', 'string', 'max:255' ],
            'cost_en' => [ 'required', 'string', 'max:255' ],
            'cost_nl' => [ 'required', 'string', 'max:255' ],
            'join_en' => [ 'required', 'string', 'max:255' ],
            'join_nl' => [ 'required', 'string', 'max:255' ],
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
        $validator->validateWithBag('activity');
    }   
}
