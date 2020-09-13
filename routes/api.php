<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return [
        'app' => 'Laravel 6 API Boilerplate',
        'version' => '1.0.0',
    ];
});

Route::group(['namespace' => 'Auth'], function () {
    Route::post('auth/login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('auth/register', ['as' => 'register', 'uses' => 'RegisterController@register']);
    // envia email de reset de senha
    Route::post('auth/recovery', 'ForgotPasswordController@sendPasswordResetLink');
    // executa o processo do formulário de reset de senha
    Route::post('auth/reset', 'ResetPasswordController@callResetPassword');
});

Route::group(['middleware' => ['jwt', 'jwt.auth']], function () {

    Route::group(['namespace' => 'Profile'], function () {
        Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@me']);
        Route::put('profile', ['as' => 'profile', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile', 'uses' => 'ProfileController@updatePassword']);
    });

    Route::group(['namespace' => 'Payback'], function () {
        Route::get('payback', ['as' => 'payback', 'uses' => 'PaybackController@me']);
        Route::post('payback', ['as' => 'payback', 'uses' => 'PaybackController@update']);

        Route::post('payback/accounts/{account_id}/generate', ['as' => 'payback', 'uses' => 'PaybackController@generate']);

        Route::get('payback/transactions', ['as' => 'payback', 'uses' => 'PaybackController@transactions']);
        Route::get('payback/history', ['as' => 'payback', 'uses' => 'PaybackController@history']);
    });

    Route::group(['namespace' => 'Charts'], function () {
        Route::get('payback/history/chart/{start}/{end}', ['as' => 'payback', 'uses' => 'PaybackHistoryChartController@history']);
    });

    Route::group(['namespace' => 'Fund'], function () {
        Route::get('funds', ['as' => 'funds', 'uses' => 'FundController@me']);
        Route::get('funds/recommend/{value}', ['as' => 'funds', 'uses' => 'FundController@recommend']);
    });

    Route::group(['namespace' => 'Investment'], function () {
        Route::get('investments', ['as' => 'investments', 'uses' => 'InvestmentController@me']);
        Route::post('investments', ['as' => 'investments', 'uses' => 'InvestmentController@update']);
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('logout', ['as' => 'logout', 'uses' => 'LogoutController@logout']);
    });

});



