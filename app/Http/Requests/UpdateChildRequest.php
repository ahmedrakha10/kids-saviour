<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest
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
            'name'         => 'nullable|max:50',
            'phone'         => 'nullable|numeric',
            'age'         => 'nullable|numeric',
            'address'         => 'nullable|max:50',
            'image'         => 'nullable|mimes:png,jpeg,jpg,svg',
            'birth_certificate'         => 'nullable|mimes:png,jpeg,jpg,svg',
            'gender'         => 'nullable|in:male,female',

        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
