<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CreateUsersController;
use App\Http\Controllers\Table\TableController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\AllIncpectorController;
use App\Http\Controllers\User\AllUsersController;
use App\Http\Controllers\Table\TableAdminController;
use App\Http\Controllers\User\SearchUserController;
use App\Http\Controllers\Table\BotController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\Video\VideoController;
use App\Http\Controllers\Incpector\IncpectorController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('reg', [CreateUsersController::class, 'reg'])->name('reg');
    Route::post('incpector', [AllIncpectorController::class,'index'])->name('incpector');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    // Route::post('me', [AuthController::class, 'me']);

    Route::group(['middleware' => 'jwt.auth'], function() {

        Route::post('role', [RoleController::class,'index']);

        Route::group(['namespace'=> 'User', 'prefix' => 'users'], function () {
            Route::post('create', [CreateUsersController::class, 'create']);
            Route::post('delete', [CreateUsersController::class, 'delete']);
            Route::post('incpector', [AllIncpectorController::class,'index']);
            Route::post('all', [AllUsersController::class,'index']);
            Route::post('search', [SearchUserController::class,'search']);
            Route::post('profile', [ProfileUserController::class,'index']);
            Route::post('bot', [BotController::class, 'index']);
        });

        Route::group(['namespace'=> 'Table', 'prefix' => 'table'], function () {
            Route::post('all', [TableController::class, 'index']);
            Route::post('update', [TableController::class, 'update']);
            Route::post('cancel', [TableController::class, 'cancel']);


            Route::group(['namespace'=> 'Table', 'prefix' => 'admin'], function() {
                Route::post('index', [TableAdminController::class, 'index']);
                Route::post('update', [TableAdminController::class, 'update']);
                Route::post('delete', [TableAdminController::class, 'delete']);
                Route::post('bot', [BotController::class, 'index']);
            });
        });

        Route::group(['namespace'=> 'Video', 'prefix' => 'video'], function () {
            Route::post('all', [VideoController::class, 'index']);
            Route::post('show', [VideoController::class, 'show']);
        });

        Route::group(['namespace'=> 'Incpector', 'prefix' => 'incpector'], function () {
            Route::post('all', [IncpectorController::class, 'index']);
            Route::post('show', [IncpectorController::class, 'show']);
            Route::post('choose', [IncpectorController::class, 'choose']);
        });

    });

});