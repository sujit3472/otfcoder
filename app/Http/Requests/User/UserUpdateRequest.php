<?php

namespace App\Http\Requests\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => ['required',
                Rule::unique('users')->ignore($this->user)],
            'phone'      => 'required|min:10|max:15',
        ];
        if (isset(FormRequest::all()['password'])) {
            $rules['password'] = 'confirmed|min:6|max:20';
        }
        return $rules;
    }
}
