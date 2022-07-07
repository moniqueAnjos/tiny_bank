<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'payer' => 'required|numeric',
            'payee' => 'required|numeric',
            'value' => 'required|numeric',
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
            'payer' => 'Pagador(a)',
            'payee' => 'Beneficiário(a)',
            'value' => 'Valor'
        ];
    }
}
