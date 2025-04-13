<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Currencies
    Route::apiResource('currencies', 'CurrenciesApiController');

    // Gold Prices
    Route::apiResource('gold-prices', 'GoldPricesApiController');
});
