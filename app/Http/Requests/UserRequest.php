<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer essa solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtem as regras de validação que se aplicam à solicitação(request).
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'cpf_cnpj' => 'required|unique:users|max:14',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:50',
            'type' => 'required|' .Rule::in(['SHOPKEEPER', 'COMMON']),
            'value' => 'nullable|numeric',
        ];
    }
    
    /**
     * Obtem os nomes que o usuário verá no erro de cada campo.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nome',
            'cpf_cnpj' => 'Cpf/Cnpj',
            'email' => 'Email',
            'password' => 'Senha',
            'type' => 'Tipo Usuário',
            'value' => 'Valor'
        ];
    }
    
}
