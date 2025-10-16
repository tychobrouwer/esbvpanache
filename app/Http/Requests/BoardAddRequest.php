<?php

namespace App\Http\Requests;

use App\Models\Board;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BoardAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule', 'array<mixed>', 'string>
     */
    public function rules(): array
    {
        return [
            'year' => [ 'required', 'integer', Rule::unique(Board::class) ],
            'chairperson' => [ 'required', 'string', 'max:255' ],
            'vice_chairperson' => [ 'required', 'string', 'max:255' ],
            'secretary' => [ 'required', 'string', 'max:255' ],
            'treasurer' => [ 'required', 'string', 'max:255' ],
            'slogan' => [ 'required', 'string', 'max:255' ],
            'message_en' => [ 'nullable', 'string' ],
            'message_nl' => [ 'nullable', 'string' ],
        ];
    }

    public function messages()
    {
        return [
            'year.unique' => __('A board for this year already exists.'),
            'year.integer' => __('The year must be a valid integer.'),
            'year.required' => __('The year field is required.'),
            'chairperson.required' => __('The chairperson field is required.'),
            'vice_chairperson.required' => __('The vice chairperson field is required.'),
            'secretary.required' => __('The secretary field is required.'),
            'treasurer.required' => __('The treasurer field is required.'),
            'slogan.required' => __('The slogan field is required.'),
            'chairperson.max' => __('The chairperson may not be greater than 255 characters.'),
            'vice_chairperson.max' => __('The vice chairperson may not be greater than 255 characters.'),
            'secretary.max' => __('The secretary may not be greater than 255 characters.'),
            'treasurer.max' => __('The treasurer may not be greater than 255 characters.'),
            'slogan.max' => __('The slogan may not be greater than 255 characters.'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->validateWithBag('board');
    }   
}
