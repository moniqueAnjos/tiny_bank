<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Providers\BuildHttpResponse;
use App\Services\TransactionService;

class TransactionController extends Controller
{

    private TransactionService $transactionService;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->transactionService = new TransactionService(
            $transactionRepository,
            $userRepository
        );
    }

    /**
     * @OA\Post(
     *   path="/transaction",
     *   tags={"Transação"},
     *   summary="Executa uma transação",
     *   description="Realiza uma transação de usuário/usuário ou usuário/lojista",
     *   operationId="transaction",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="value",
     *                   description="Valor Transação",
     *                   type="number",
     *                   format="float",
     *                   example="100.00"
     *               ),
     *               @OA\Property(
     *                   property="payer",
     *                   description="Pagador(a)",
     *                   type="number",
     *                   example=2
     *               ),
     *               @OA\Property(
     *                   property="payee",
     *                   description="Beneficiário(a)",
     *                   type="number",
     *                   example=1
     *               )
     *           )
     *       )
     *   ),
     *  @OA\Response(
     *         response="200",
     *         description="ok",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         description="Mensagem de sucesso ou erro"
     *                     ),
     *                     @OA\Property(
     *                         property="statusCode",
     *                         type="integer",
     *                         description="Status da requisição(sucesso ou erro)"                         
     *                     ),
     *                     @OA\Property(
     *                         property="result",
     *                         type="integer",
     *                         description="Resultado da requisição(true ou false)",
     *                     ),
     *                     example={
     *                         "message": "Transação realizada com sucesso.",
     *                         "statusCode": 200,
     *                         "result": true
     *                     }
     *                 )
     *             )
     *         }
     *     ), 
     *   @OA\Response(response=403, description="Transação não autorizada."), 
     *   @OA\Response(response=422, description="Você não possui saldo suficiente para realizar a transação."), 
     *   @OA\Response(response=500, description="Ocorreu um problema durante a transação."), 
     *   @OA\Response(response=404, description="Registro não encontrado"), 
     *   
     * )
     */
    public function transaction(TransactionRequest $request)
    {
        $transactionData = $request->only([
            "value",
            "payer",
            "payee"
        ]);
        $this->transactionService->createTransaction($transactionData);
        return BuildHttpResponse::formatResponse(
            'Transação realizada com sucesso.',
            200,
            true
        );
    }
   
}
