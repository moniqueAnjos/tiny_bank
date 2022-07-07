<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $User)
    {
        $User->create([
            'name' => 'Monique Arcanjo',
            "cpf_cnpj" => "66114712005",
            "email" => "monique@gmail.com",
            "password" => "8556564",
            "type" => "COMMON",
            "value" => 1000.85
        ]);
        $User->create([
            'name' => 'João Henrique',
            "cpf_cnpj" => "42856335071",
            "email" => "joao@gmail.com",
            "password" => "4165462",
            "type" => "SHOPKEEPER",
            "value" => 400.90
        ]);
        $User->create([
            'name' => 'Vinicius Matheus',
            "cpf_cnpj" => "22172279048",
            "email" => "vinicius@gmail.com",
            "password" => "4165462",
            "type" => "COMMON",
            "value" => 785.55
        ]);
    }
}
