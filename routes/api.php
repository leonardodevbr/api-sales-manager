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

        $router->group(['prefix' => 'products'], function ($router) {
            $router->get('/', [ProductController::class, "index"]);
            $router->get('/{id}', [ProductController::class, "show"]);
            $router->put('/', [ProductController::class, "store"]);
            $router->post('/{id}', [ProductController::class, "update"]);
            $router->delete('/{id}', [ProductController::class, "destroy"]);
        });

        $router->group(['prefix' => 'sellers'], function ($router) {
            $router->get('/', [SellerController::class, "index"]);
            $router->get('/{id}', [SellerController::class, "show"]);
            $router->put('/', [SellerController::class, "store"]);
            $router->post('/{id}', [SellerController::class, "update"]);
            $router->delete('/{id}', [SellerController::class, "destroy"]);
        });

        $router->group(['prefix' => 'orders'], function ($router) {
            $router->get('/', [OrderController::class, "index"]);
            $router->get('/{id}', [OrderController::class, "show"]);
            $router->put('/', [OrderController::class, "store"]);
            $router->post('/{id}', [OrderController::class, "update"]);
            $router->delete('/{id}', [OrderController::class, "destroy"]);
        });

    });
});
