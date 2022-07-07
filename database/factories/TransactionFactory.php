<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Defina o estado padrão do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => 100.20,
            'payer' => 1,
            'payee' => 4
        ];
    }
}
