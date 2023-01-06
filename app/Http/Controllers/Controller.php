<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Oracle API documentation",
 *      description="Discord Bot Documentation for Oracle",
 *      @OA\Contact(
 *          email="help@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Main API URL"
 * )
 *
 * @OA\Tag(
 *     name="Oracle Discord Bot",
 *     description="API Endpoints of the Oracle discord bot"
 * )
 * @OA\SecurityScheme(
 *       scheme="Bearer",
 *       securityScheme="Bearer",
 *       type="apiKey",
 *       in="header",
 *       name="Authorization",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
