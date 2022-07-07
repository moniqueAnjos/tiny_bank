<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Server(
 *      url="http://localhost:8000/api",
 *      description="Servidor Local"
 *  )
 * @OA\Info(
 *      version="1.0.0",
 *      title="Tiny Bank",
 *      description="Api de transação",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      )     
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
