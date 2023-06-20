<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'name'      => 'required|unique:regions',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

           $region = $this->route()->parameter('region');
           //dd($region);
            $rules['name'] = 'required|unique:regions,name,' . $region;

        }//end of if

        return $rules;

    }//end of rules

}//end of request
