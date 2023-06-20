<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'name'           => 'required|array',
            'name.ar'        => 'required|max:150',
            'name.en'        => 'required|max:150',
            'tags_list'      => 'required|array',
            'description'    => 'required|array',
            'description.ar' => 'required',
            'description.en' => 'required',
            'aqar_tip_id'    => 'required|exists:aqar_tips,id',
            'image'          => 'required|image|mimes:jpeg,jpg,png,gif,svg',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = 'image|mimes:jpeg,jpg,png,gif,svg';

        }//end of if

        return $rules;

    }//end of rules

}//end of request
