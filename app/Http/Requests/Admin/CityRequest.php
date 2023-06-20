<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name.ar' => 'required|unique:cities,name->ar',
            'name.en' => 'required|unique:cities,name->en',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $city = request()->segment(4);
            $rules['name.ar'] = 'required|unique:cities,name->ar,' . $city;
            $rules['name.en'] = 'required|unique:cities,name->en,' . $city;

        }//end of if

        return $rules;

    }//end of rules

}//end of request
