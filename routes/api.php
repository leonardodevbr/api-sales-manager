<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function ($router) {
    $router->group(['prefix' => 'auth'], function ($router) {
        $router->post('login', [AuthController::class, "login"]);

        $router->group(['middleware' => 'apiJwt'], function ($router) {
            $router->post('logout', [AuthController::class, "logout"]);
            $router->post('refresh', [AuthController::class, "refresh"]);
            $router->post('me', [AuthController::class, "me"]);
        });
    });

    $router->group(['middleware' => ['apiJwt']], function ($router) {
        $router->group(['prefix' => 'products'], function ($router) {
            $router->get('/', [ProductController::class, "index"]);
        });

        $router->group(['prefix' => 'customers'], function ($router) {
            $router->get('/', [CustomerController::class, "index"]);
            $router->get('/{id}', [CustomerController::class, "show"]);
            $router->put('/', [CustomerController::class, "store"]);
            $router->post('/{id}', [CustomerController::class, "update"]);
            $router->delete('/{id}', [CustomerController::class, "destroy"]);
        });

    });
});
