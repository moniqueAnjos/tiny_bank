<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController  extends Controller
{
    private UserService $userService;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userService = new UserService($userRepository);
    }

    /**
     * @OA\Get( 
     *     tags={"Usuario"},
     *     operationId="index",
     *     summary="Retorna a lista de usuários",
     *     description="Retorna todos os usuários do banco e paginados",
     *     path="/user",
     *     @OA\Response(
     *          response="200", 
     *          description="Retorna listagem de usuários",
     *      )
     * )
     * @return User
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->userService->getAllUsers()
        ]);
    }

    /**
     * @OA\Post(
     *   path="/user",
     *   tags={"Usuario"},
     *   summary="Cria usuário comum ou lojista",
     *   description="Insere novos usuários no banco de dados",
     *   operationId="store",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Nome Usuário",
     *                   type="string",
     *                   example="Monique Arcanjo"
     *               ),
     *               @OA\Property(
     *                   property="cpf_cnpj",
     *                   description="CPF/CNPJ Usuário",
     *                   type="string",
     *                   example="44455562158"
     *               ),
     *               @OA\Property(
     *                   property="email",
     *                   description="Email usuário",
     *                   type="string",
     *                   example="monique.santos22.ms@gmail.com"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   description="Senha Usuário",
     *                   type="string",
     *                   example="teste123"
     *               ),
     *               @OA\Property(
     *                   property="type",
     *                   description="Tipo do usuário",
     *                   type="string",
     *                   example="COMMON"
     *               ),
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
     *                         property="data",
     *                         type="json",
     *                         description="Dados Inseridos"
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
     *                         "message": "Dados inseridos com sucesso.",
     *                         "data": {},
     *                         "statusCode": 200,
     *                         "result": true
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     * )
     */
    public function store(UserRequest $request): JsonResponse
    {
        $userData = $request->only([
            "name",
            "cpf_cnpj",
            "email",
            "password",
            "type",
        ]);
        $user = $this->userService->createUser($userData);
        return response()->json(
            [
                'message' => 'Dados inseridos com sucesso.',
                'data' => $user,
                'statusCode' => Response::HTTP_CREATED,
                'result' => true
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *      path="/user/{id}",
     *      operationId="show",
     *      tags={"Usuario"},
     *      summary="Retorna informações do usuário",
     *      description="Retorna dados do usuário",
     *      @OA\Parameter(
     *          name="id",
     *          description="Usuário id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *       ),
     *      @OA\Response(response=404, description="Registro Models\\User não encontrado"),      
     * )
     * @return User
     */
    public function show($userId): JsonResponse
    {
        $user =  $this->userService->getUserById($userId);

        return response()->json($user);
    }
}
