<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeAddRequest extends FormRequest
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
            'description_en' => [ 'nullable', 'string' ],
            'description_nl' => [ 'nullable', 'string' ],
            'is_general' => [ 'required', 'boolean' ],
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => __('The title is required.'),
            'title_en.string' => __('The title must be a string.'),
            'title_en.max' => __('The title may not be greater than 255 characters.'),
            'title_nl.required' => __('The title is required.'),
            'title_nl.string' => __('The title must be a string.'),
            'title_nl.max' => __('The title may not be greater than 255 characters.'),
            'description_en.string' => __('The description must be a string.'),
            'description_nl.string' => __('The description must be a string.'),
            'is_general.required' => __('The general flag is required.'),
            'is_general.boolean' => __('The general flag must be true or false.'),
        ];
    }

    public function withValidator($validator)
    {
        if ($this['id'] > 0) {
            $validator->validateWithBag('committeeUpdate');
        } else {
            $validator->validateWithBag('committeeCreate');
        }
    }
}
