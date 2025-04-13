<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Currencies
    Route::delete('currencies/destroy', 'CurrenciesController@massDestroy')->name('currencies.massDestroy');
    Route::post('currencies/parse-csv-import', 'CurrenciesController@parseCsvImport')->name('currencies.parseCsvImport');
    Route::post('currencies/process-csv-import', 'CurrenciesController@processCsvImport')->name('currencies.processCsvImport');
    Route::resource('currencies', 'CurrenciesController');

    // Gold Prices
    Route::delete('gold-prices/destroy', 'GoldPricesController@massDestroy')->name('gold-prices.massDestroy');
    Route::post('gold-prices/parse-csv-import', 'GoldPricesController@parseCsvImport')->name('gold-prices.parseCsvImport');
    Route::post('gold-prices/process-csv-import', 'GoldPricesController@processCsvImport')->name('gold-prices.processCsvImport');
    Route::resource('gold-prices', 'GoldPricesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::get('/', [App\Http\Controllers\CurrencyController::class, 'home'])->name('home');
Route::get('/currency/{currencyCode}/history', [App\Http\Controllers\CurrencyController::class, 'history'])->name('currency.history');
Route::get('/terms', [App\Http\Controllers\CurrencyController::class, 'terms'])->name('terms');
Route::get('/privacy', [App\Http\Controllers\CurrencyController::class, 'privacy'])->name('privacy');
