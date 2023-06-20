<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AqarRequest extends FormRequest
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
            'name.ar'           => 'required|max:150',
            'name.en'           => 'required|max:150',
            'description.ar'    => 'required',
            'description.en'    => 'required',
            'rent_type'         => 'required|in:monthly,annual',
            'aqar_kind_id'      => 'required|in:1,2',
            'registered'        => 'required|in:yes,no,recordable',
            'finishing_type_id' => 'required|exists:finishing_types,id',
            'payment_method'    => 'required|in:cache,installment',
            'aqar_category_id'  => 'required|exists:aqar_categories,id',
            'region_id'         => 'required|exists:regions,id',
            'aqar_type_id'      => 'required|exists:aqar_types,id',
            'price'             => 'required|numeric',
            'width'             => 'required|numeric',
            'floor'             => 'required|numeric',
            'phone'             => 'required|numeric',
            'bed_rooms'         => 'required|numeric',
            'building_year'     => 'required|numeric',
            'bath_rooms'        => 'required|numeric',
            'ads_type_id'       => 'exists:ads_types,id',
            'image.*'           => 'mimes:jpeg,jpg,png,bmp,gif,svg',
            'status'            => 'in:draft,published,pending,rejected,unavailable',
        ];


        return $rules;

    }//end of rules

}//end of request
