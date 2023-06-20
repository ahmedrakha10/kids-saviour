<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AqarFeatureRequest extends FormRequest
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
            'name'    => 'required|array',
            'name.ar' => 'required|unique:aqar_additions,name->ar',
            'name.en' => 'required|unique:aqar_additions,name->en',
            'image'   => 'required|image|mimes:jpeg,jpg,png,gif,svg',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $aqarFeature = request()->segment(4);
            $rules['name.ar'] = 'required|unique:aqar_additions,name->ar,' . $aqarFeature;
            $rules['name.en'] = 'required|unique:aqar_additions,name->en,' . $aqarFeature;
            $rules['image'] = 'image|mimes:jpeg,jpg,png,gif,svg';

        }//end of if

        return $rules;

    }//end of rules

}//end of request
