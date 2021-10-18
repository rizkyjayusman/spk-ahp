<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,$this->id,id',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required|min:5|same:password',
        ];
    }
}
