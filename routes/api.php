<?php

use App\Http\Controllers\BondController;
use Illuminate\Support\Facades\Route;

/**
 * You mentioned 'bond' as the endpoint in the task you sent. However, according to the JSON API standards, resources should be noted in plural.
 * Docs: https://jsonapi.org/format/#crud
 */
Route::group(['prefix' => 'bonds', 'controller' => BondController::class], function (): void {
    Route::post('/', 'create');
    Route::get('/{id}/payouts', 'payouts');
    Route::post('{id}/order', 'order');
    Route::get('/orders/{id}', 'orderPayouts');
});
