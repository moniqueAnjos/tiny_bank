<?php

namespace App\Interfaces;

interface  TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function createTransaction(array $userDetails, $valuePayer, $valuePayee);
    public function sendNotificaction();
    public function validateTransaction();
}
