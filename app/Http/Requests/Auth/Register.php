<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'email|unique:users|required',
            'password' => 'min:5|required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Esse nome não é válido',
            'name.min' => 'Informe um nome com 3 ou mais caracteres',
            'email.email' => 'Esse email não é válido',
            'email.unique' => 'Esse email já está em uso',
            'email.required' => 'Informe um email',
            'password.min' => 'Informe uma senha coom 5 ou mais dígitos',
            'password.required' => 'Informe uma senha'
        ];
    }
}
