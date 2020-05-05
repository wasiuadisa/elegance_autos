<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsFormRequest extends FormRequest
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
            'name'          => 'required|string|between:10,40',
            'email'         => 'required|string|between:0,50',
            'phone'         => 'required|string|between:10,15',
            'message'       => 'required|string|between:0,1500',
        ];
    }
}
