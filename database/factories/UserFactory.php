<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Defina o estado padrão do modelo.
     *
     * @return array
     */
    public function definition($type = "COMMON")
    {
        return [
            'name' => $this->faker->name(),
            'cpf_cnpj' => Str::random(14),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '123456', 
            'type' => $type,
        ];
    }

    /**
     * Indique que o endereço de e-mail do modelo não deve ser verificado.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => null,
            ];
        });
    }
}
