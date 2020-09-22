<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'model'=>'required',
        ];
    }

    public function messages()
    {
        return [
//            'first_name.required' => 'first_name required.',
//            'email.required' => 'email required.',
//            'email.unique' => 'email already in use.',
//            'email.min' => 'Username needs to be above 1',
//            'email.max' => 'Username needs to be below 35',
//            'email.min' => 'Password needs to be above 7',
//            'email.max' => 'Username needs to be below 35',
        ];
    }
}
