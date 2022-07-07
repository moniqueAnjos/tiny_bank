<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_users()
    {
        $user = User::factory()->create();

        $response = $this->get('api/user');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $user["name"],
                "cpf_cnpj" => $user["cpf_cnpj"],
                "email" => $user["email"],
            ]);
    }

    public function test_create_user()
    {
        $user = User::factory()->definition('SHOPKEEPER');

        $response = $this->postJson('/api/user', $user);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => $user["name"],
                "cpf_cnpj" => $user["cpf_cnpj"],
                "email" => $user["email"],
            ]);
    }

    public function test_get_id_user()
    {
        $user = User::factory()->create();

        $response = $this->get('api/user/' . $user["id"]);

        $response->assertStatus(200);
    }
}
