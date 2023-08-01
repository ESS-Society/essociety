<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$router->get('/', function () {
    return redirect()->route('leaguefy.admin.index');
})->name('index');

Route::group([
    'middleware' => ['guest'],
    'as' => 'auth.',
], function (Router $router) {
    $router->get('/auth/register', [Controllers\RegisterController::class, 'view'])
        ->name('register');
    $router->get('/auth/login', [Controllers\AuthController::class, 'view'])
        ->name('login');
    $router->post('/auth/register', [Controllers\RegisterController::class, 'register']);
    $router->post('/auth/login', [Controllers\AuthController::class, 'login']);

    Route::group([
        'as' => 'password.',
    ], function (Router $router) {
        $router->get('/auth/password/email', [Controllers\PasswordResetController::class, 'tokenRequestView'])
            ->name('request');
        $router->post('/auth/password/email', [Controllers\PasswordResetController::class, 'tokenRequestResetLink'])
            ->name('email');
        $router->get('/auth/password/reset', [Controllers\PasswordResetController::class, 'resetPasswordView'])
            ->name('reset');
        $router->post('/auth/password/reset', [Controllers\PasswordResetController::class, 'resetPassword'])
            ->name('update');
    });
});

$router->post('/auth/logout', [Controllers\AuthController::class, 'logout'])->name('auth.logout');
