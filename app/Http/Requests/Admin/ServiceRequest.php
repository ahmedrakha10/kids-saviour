<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name.ar' => 'required|unique:services,name->ar',
            'name.en' => 'required|unique:services,name->en',
            'image'   => 'required|image|mimes:jpeg,jpg,png,gif,svg',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $aqarType = request()->segment(4);
            $rules['name.ar'] = 'required|unique:services,name->ar,' . $aqarType;
            $rules['name.en'] = 'required|unique:services,name->en,' . $aqarType;
            $rules['image'] = 'image|mimes:jpeg,jpg,png,gif,svg';

        }//end of if

        return $rules;

    }//end of rules

}//end of request
