<?php

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\AqarIndexController;
use App\Http\Controllers\Api\AqarTipsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\WalletController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api', 'middleware' => 'setlocale'], function () {
    // Auth Cycle
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'signup']);
    Route::post('social-login', [AuthController::class, 'social_login']);
    Route::post('forget-password', [AuthController::class, 'forget_password']);
    Route::post('verify-code', [AuthController::class, 'verifyCode']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::get('profile', [AuthController::class, 'showProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    Route::post('add-child', [MainController::class, 'addChild']);
    Route::get('my-children', [MainController::class, 'myChildren']);
    Route::post('lost-child/{id}', [MainController::class, 'lostChild']);
    Route::post('find-child/{id}', [MainController::class, 'findChild']);
    Route::post('update-child/{id}', [MainController::class, 'updateChild']);
    Route::delete('delete-child/{id}', [MainController::class, 'deleteChild']);
    Route::get('home', [MainController::class, 'home']);
    Route::get('child/{id}', [MainController::class, 'childInfo']);
    Route::get('search', [MainController::class, 'search']);


});
