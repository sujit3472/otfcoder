<?php

namespace App\Http\Requests\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        $rules = [];
        $rules = [
            'first_name' => 'required|max:80',
            'last_name'  => 'required|max:80',
            /*// 'email'      => ['required',
                Rule::unique('users')->ignore($this->user)],*/
            'email' => 'required|unique:users,email,'.FormRequest::all()['id'].'|regex:/^[A-z][A-z0-9_.\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/',
            'phone'      => 'required|min:10|max:15',
        ];
        if (isset(FormRequest::all()['password'])) {
            $rules['password'] = 'confirmed|min:6|max:20';
        }
        return $rules;
    }
}
