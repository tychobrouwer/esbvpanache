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
            
        ];
    }

    public function withValidator($validator)
    {
        $validator->validateWithBag('board');
    }   
}
