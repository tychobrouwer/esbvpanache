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
            'date' => [ 'required', Rule::date()->format('d-m-Y') ],
            'content_en' => [ 'required', 'string' ],
            'content_nl' => [ 'required', 'string' ],
        ];
    }

    public function messages(): array
    {
        return [
            'title_en.required' => __('The title is required.'),
            'title_nl.required' => __('The title is required.'),
            'date.required' => __('The date is required.'),
            'date.date' => __('The date must be a valid date in the format YYYY-MM-DD.'),
            'content_en.required' => __('The content is required.'),
            'content_nl.required' => __('The content is required.'),
        ];
    }
}
