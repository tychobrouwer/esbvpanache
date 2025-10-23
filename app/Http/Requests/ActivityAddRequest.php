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
            'date' => [ 'required', Rule::date()->format('Y-m-d H:i') ],
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
            'title_en.required' => __('The title is required.'),
            'title_en.string' => __('The title must be a string.'),
            'title_en.max' => __('The title may not be greater than 255 characters.'),
            'title_nl.required' => __('The title is required.'),
            'title_nl.string' => __('The title must be a string.'),
            'title_nl.max' => __('The title may not be greater than 255 characters.'),
            'date.required' => __('The date is required.'),
            'date.date' => __('The date must be a valid date in the format DD-MM-YYYY HH:MM.'),
            'duration.digits_between' => __('The duration must be a number between 0 and 1.'),
            'duration.min' => __('The duration must be at least 0.'),
            'location_en.required' => __('The location is required.'),
            'location_en.string' => __('The location must be a string.'),
            'location_en.max' => __('The location may not be greater than 255 characters.'),
            'location_nl.required' => __('The location is required.'),
            'location_nl.string' => __('The location must be a string.'),
            'location_nl.max' => __('The location may not be greater than 255 characters.'),
            'cost_en.required' => __('The cost is required.'),
            'cost_en.string' => __('The cost must be a string.'),
            'cost_en.max' => __('The cost may not be greater than 255 characters.'),
            'cost_nl.required' => __('The cost is required.'),
            'cost_nl.string' => __('The cost must be a string.'),
            'cost_nl.max' => __('The cost may not be greater than 255 characters.'),
            'join_en.required' => __('The join information is required.'),
            'join_en.string' => __('The join information must be a string.'),
            'join_en.max' => __('The join information may not be greater than 255 characters.'),
            'join_nl.required' => __('The join information is required.'),
            'join_nl.string' => __('The join information must be a string.'),
            'join_nl.max' => __('The join information may not be greater than 255 characters.'),
            'content_en.required' => __('The content is required.'),
            'content_en.string' => __('The content must be a string.'),
            'content_nl.required' => __('The content is required.'),
            'content_nl.string' => __('The content must be a string.'),
        ];
    }
}
