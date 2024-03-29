<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\SellerController;
use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\OrderController;
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
            $router->get('me', [AuthController::class, "me"]);
        });
    });

    $router->group(['middleware' => ['apiJwt']], function ($router) {
        $router->group(['prefix' => 'products'], function ($router) {
            $router->get('/', [ProductController::class, "index"]);
        });

        $router->group(['prefix' => 'customers'], function ($router) {
            $router->get('/', [CustomerController::class, "index"]);
            $router->get('/{id}', [CustomerController::class, "show"]);
            $router->post('/', [CustomerController::class, "store"]);
            $router->put('/{id}', [CustomerController::class, "update"]);
            $router->delete('/{id}', [CustomerController::class, "destroy"]);
        });

        $router->group(['prefix' => 'products'], function ($router) {
            $router->get('/', [ProductController::class, "index"]);
            $router->get('/{id}', [ProductController::class, "show"]);
            $router->post('/', [ProductController::class, "store"]);
            $router->put('/{id}', [ProductController::class, "update"]);
            $router->delete('/{id}', [ProductController::class, "destroy"]);
        });

        $router->group(['prefix' => 'sellers'], function ($router) {
            $router->get('/', [SellerController::class, "index"]);
            $router->get('/{id}', [SellerController::class, "show"]);
            $router->post('/', [SellerController::class, "store"]);
            $router->put('/{id}', [SellerController::class, "update"]);
            $router->delete('/{id}', [SellerController::class, "destroy"]);
        });

        $router->group(['prefix' => 'orders'], function ($router) {
            $router->get('/', [OrderController::class, "index"]);
            $router->get('/{id}', [OrderController::class, "show"]);
            $router->post('/', [OrderController::class, "store"]);
            $router->put('/{id}', [OrderController::class, "update"]);
            $router->delete('/{id}', [OrderController::class, "destroy"]);
        });

    });
});
