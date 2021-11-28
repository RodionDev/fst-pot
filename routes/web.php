<?php
View::composer('*', function($view){
    View::share('view_name', $view->getName());
});
Route::view('/', 'frontend.pages.primary.front')->name('front');
Route::view('produkt', 'frontend.pages.primary.produkt')->name('produkt');
Route::view('impressum', 'frontend.pages.secondary.impressum')->name('impressum');
Route::view('datenschutz', 'frontend.pages.secondary.datenschutz')->name('datenschutz');
Route::get('api/demo', 'Test\JsonDemoController@index')->name('json-demo');
Auth::routes(['verify' => true]);
Route::group(['middleware' => ['verified']], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::middleware('can:manage-vspot')->group(function () {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });
    Route::middleware('can:manage-users')->group(function () {
        Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
            Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            Route::get('registrations', 'UsersController@indexRegistrations');
        });
    });
    Route::middleware('can:manage-signage')->group(function () {
        Route::resource('devices', 'DeviceController', ['except' => ['show']]);
        Route::resource('channels', 'ChannelController', ['except' => ['show']]);
    });
    Route::middleware('can:run-tests')->group(function () {
        Route::namespace('Test')->name('test.')->prefix('test')->group(function () {
            Route::get('email', 'TestFrontendController@email')->name('test-email');
            Route::prefix('qrcode')->group(function () {
                Route::get('email', 'TestQRCodeController@email');
                Route::get('link', 'TestQRCodeController@link');
                Route::get('phone', 'TestQRCodeController@phone');
            });
        });
    });
});
