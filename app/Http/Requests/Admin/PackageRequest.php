<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'name'            => 'required|array',
            'name.ar'         => 'required|unique:packages,name->ar',
            'name.en'         => 'required|unique:packages,name->en',
            'period'          => 'required|array',
            'period.ar'       => 'required',
            'period.en'       => 'required',
            'views_number'    => 'required|array',
            'views_number.ar' => 'required',
            'views_number.en' => 'required',
            'position'        => 'nullable|array',
            'position.ar'     => 'nullable',
            'position.en'     => 'nullable',
            'price'           => 'required|numeric',
            'type'            => 'required|in:individual,companies',
            'total_ads'       => 'required_if:type,=,companies',
            'normal_ads'      => 'required_if:type,=,companies',
            'special_ads'     => 'required_if:type,=,companies',
            'vip_ads'         => 'required_if:type,=,companies',
            'banner_ads'      => 'required_if:type,=,companies',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $package = request()->segment(4);
            $rules['name.ar'] = 'required|unique:packages,name->ar,' . $package;
            $rules['name.en'] = 'required|unique:packages,name->en,' . $package;


        }//end of if

        return $rules;

    }//end of rules

}//end of request
