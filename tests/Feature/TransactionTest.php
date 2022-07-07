<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_transaction()
    {
        $userPayerCreated = User::factory()->definitionWithValue("COMMON", 1000);
        $userPayeeCreated = User::factory()->definitionWithValue("COMMON", 2000);

        $userPayer = User::factory()->create($userPayerCreated);
        $userPayee = User::factory()->create($userPayeeCreated);

        $dataCreated = [
            'value' => 100, 00,
            "payer" => $userPayer["id"],
            "payee" => $userPayee["id"],
        ];

        $response = $this->postJson('/api/transaction', $dataCreated);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Transação realizada com sucesso.',
                'statusCode' => 200,
                'result' =>  true
            ]);
    }
}
