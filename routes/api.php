<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PayController;
use App\Http\Controllers\Api\ClientController;

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

Route::group(['prefix' => 'client'], function () {
    Route::get('list', [ClientController::class, 'clientList'])->name('client.list');
    Route::post('create', [ClientController::class, 'createClient'])->name('client.add-client');
    Route::put('change-status', [ClientController::class, 'changeClientStatus'])->name('client.change-client-status');
});

Route::group(['prefix' => 'pay'], function () {
    Route::post('add', [PayController::class, 'addPay'])->name('pay.add-pay');
    Route::put('cancel', [PayController::class, 'cancelPay'])->name('pay.cancel-pay');
    Route::get('report', [PayController::class, 'paysReportShow'])->name('pay.report-show');
});
