<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|unique:users,email',
            'password'     => 'required|confirmed|min:6|max:20',
            'role_id'      => 'required',
            'phone'        => 'required|min:10|max:15',
        ];
    }
}
