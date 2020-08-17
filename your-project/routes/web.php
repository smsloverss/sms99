<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:web'])->group(function ()
{

    Route::get('/message', ['uses' => 'SMSMessageController@form', 'as' => 'message.form']);
    Route::post('/message', ['uses' => 'SMSMessageController@send', 'as' => 'message.send']);

    Route::get('/dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard']);

    Route::get('/payment', [ 'uses' => 'PaymentController@show', 'as' => 'payment.show' ]);
    Route::post('/payment/create', ['uses' => 'PaymentController@create', 'as' => 'payment.create']);

    Route::get('/settings', ['uses' => 'SettingsController@show', 'as' => 'settings.show']);
    Route::post('/settings', ['uses' => 'SettingsController@changePassword', 'as' => 'settings.change']);

});

Route::get('/', function ()
{
    return redirect()->route('login');
});

Route::post('/payment/webhook', [ 'uses' => 'PaymentController@webhook', 'as' => 'payment.webhook' ]);

Route::get('/login', ['uses' => 'AuthController@showForm', 'as' => 'login']);
Route::post('/login', ['uses' => 'AuthController@login', 'as' => 'login.perform']);

Route::get('/signup', ['uses' => 'AuthController@showRegister', 'as' => 'register']);
Route::post('/signup', ['uses' => 'AuthController@register', 'as' => 'register.perform']);
