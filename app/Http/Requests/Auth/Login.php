<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'email' => 'email|required',
            'password' => 'min:5|required'
        ];
    }


    public function messages()
    {
        return [
            'email.email' => 'Esse email não é válido',
            'email.required' => 'Informe um email',
            'password.min' => 'Informe uma senha com 5 ou mais dígitos',
            'password.required' => 'Informe uma senha'
        ];
    }
}
