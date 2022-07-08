<?php

namespace App\Services;

use App\Interfaces\{
    TransactionRepositoryInterface,
    UserRepositoryInterface,
};
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class TransactionService
{
    private TransactionRepositoryInterface $transactionRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function createTransaction($transactionData)
    {
        $userPayer = $this->validateExistenceUser($transactionData["payer"]);
        $userPayee = $this->validateExistenceUser($transactionData["payee"]);
        $this->validateTypeUser($userPayer["type"]);
        $this->validateEnoughValue($userPayer["value"], $transactionData["value"]);
        $this->validateAuthorization();

        $newValuePayer = $userPayer["value"] - $transactionData["value"];
        $newValuePayee = $userPayee["value"] + $transactionData["value"];

        $this->makeTransaction(
            $transactionData,
            $newValuePayer,
            $newValuePayee
        );
        $this->transactionRepository->sendNotificaction();
    }

    private function makeTransaction($transactionData, $valuePayer, $valuePayee)
    {
        $transaction = $this->transactionRepository->createTransaction(
            $transactionData,
            $valuePayer,
            $valuePayee
        );
        if (!$transaction) {
            throw new Exception(
                'Ocorreu um problema durante a transação.',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return $transaction;
    }

    public function getAllTransactions()
    {
        return $this->transactionRepository->getAllTransactions();
    }

    private function validateAuthorization()
    {
        if ($this->transactionRepository->validateTransaction() != 'Autorizado') {
            throw new Exception(
                'Transação não autorizada.',
                Response::HTTP_FORBIDDEN
            );
        }
    }

    private function validateExistenceUser($idUser)
    {
        $user = $this->userRepository->getUserById($idUser);
        if ($user == null) {
            throw new ModelNotFoundException();
        }
        return $user;
    }

    private function validateTypeUser($type)
    {
        if ($type != 'COMMON') {
            throw new AuthorizationException();
        }
    }

    private function validateEnoughValue($valueUser, $valueTransaction)
    {
        if ($valueUser < $valueTransaction) {
            throw new Exception(
                'Você não possui saldo suficiente para realizar a transação.',
                422
            );
        }
    }
}
