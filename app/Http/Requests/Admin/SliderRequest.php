<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $rules = [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
            'sort'  => 'required|numeric',
            'type'  => 'required|in:normal,special,vip',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = 'image|mimes:jpeg,jpg,png,gif,svg';

        }//end of if

        return $rules;

    }//end of rules

}//end of request
