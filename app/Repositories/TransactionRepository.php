<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::orderby('id', 'desc')->paginate();
    }

    public function createTransaction(array $userDetails, $valuePayer, $valuePayee)
    {
        DB::transaction(function () use ($userDetails, $valuePayer, $valuePayee) {
            $payerUpdated =  $this->updateUserValue($userDetails["payer"], $valuePayer);
            $payeeUpdated = $this->updateUserValue($userDetails["payee"], $valuePayee);
            $transaction = Transaction::create($userDetails);

            if (!($payerUpdated && $payeeUpdated && $transaction)) {
                DB::rollBack();
                return false;
            }
        });
        return true;
    }

    public function sendNotificaction()
    {
        $client = new Client([
            'base_uri' => 'http://o4d9z.mocklab.io/notify',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
        $response = $client->get('');
        $body = json_decode($response->getBody()->getContents());
        return $body->message;
    }

    public function validateTransaction()
    {
        $client = new Client([
            'base_uri' => 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6/',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
        $response = $client->get('');
        $body = json_decode($response->getBody()->getContents());
        return $body->message;
    }

    private function updateUserValue($userId, $value)
    {
        return User::where("id", $userId)->update([
            "value" => $value
        ]);
    }
}
