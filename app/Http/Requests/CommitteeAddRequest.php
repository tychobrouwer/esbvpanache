<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_nl' => ['required', 'string', 'max:255'],
            'description_en' => ['string'],
            'description_nl' => ['string'],
            'is_general' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }

    public function withValidator($validator)
    {
        $validator->validateWithBag('addCommittee');
    }   
}
