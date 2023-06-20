<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|max:50',
            'phone'         => 'required|numeric',
            'age'         => 'required|numeric',
            'address'         => 'required|max:50',
            'image'         => 'required|mimes:png,jpeg,jpg,svg',
            'birth_certificate'         => 'required|mimes:png,jpeg,jpg,svg',
            'gender'         => 'required|in:male,female',

        ];
    }

    public function messages()
    {
        return [
            'price_to.gt' => __('price to field should be greater than price from field'),
            'width_to.gt' => __('width to field should be greater than width from field'),
        ];
    }
}
