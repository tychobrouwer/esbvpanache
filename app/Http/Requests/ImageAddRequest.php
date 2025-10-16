<?php

namespace App\Http\Requests;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImageAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule', 'array<mixed>', 'string>
     */
    public function rules(): array
    {
        return [
            'tag' => [ 'required', 'alpha_dash', 'max:50', Rule::unique(Image::class) ],
            'image' => [ 'required', 'file', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg,webp' ],
        ];
    }

    public function messages()
    {
        return [
            'tag.required' => __('The tag field is required.'),
            'tag.alpha_dash' => __('The tag may only contain letters, numbers, dashes, and underscores.'),
            'tag.max' => __('The tag may not be greater than 50 characters.'),
            'tag.unique' => __('The tag has already been taken.'),
            'image.required' => __('The image field is required.'),
            'image.file' => __('The image must be a file.'),
            'image.max' => __('The image may not be greater than 2MB.'),
            'image.mimes' => __('The image must be a file of type: jpeg, png, jpg, gif, svg, webp.'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->validateWithBag('image');
    }   
}
