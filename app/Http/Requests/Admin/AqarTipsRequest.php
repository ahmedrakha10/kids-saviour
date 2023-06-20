<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AqarTipsRequest extends FormRequest
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
            'name.ar' => 'required|unique:aqar_tips,name->ar',
            'name.en' => 'required|unique:aqar_tips,name->en',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $aqarTips = request()->segment(4);
            $rules['name.ar'] = 'required|unique:aqar_tips,name->ar,' . $aqarTips;
            $rules['name.en'] = 'required|unique:aqar_tips,name->en,' . $aqarTips;

        }//end of if

        return $rules;

    }//end of rules

}//end of request
