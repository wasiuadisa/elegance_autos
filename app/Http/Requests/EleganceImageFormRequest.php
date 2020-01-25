<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleganceImageFormRequest extends FormRequest
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
            //This form data go in the post's image table
            'PostID'    => 'required|integer',
//            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'file'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
//            'file'          => 'required|image|size:5120', //5120 = 5mb
            'Caption'   => 'required|string|between:0,200',
        ];
    }
}
