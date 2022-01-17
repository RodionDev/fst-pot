<?php
View::composer('*', function($view){
    View::share('view_name', $view->getName());
});
Route::view('/', 'frontend.pages.primary.front')->name('front');
Route::view('produkt', 'frontend.pages.primary.produkt')->name('produkt');
Route::view('impressum', 'frontend.pages.secondary.impressum')->name('impressum');
Route::view('datenschutz', 'frontend.pages.secondary.datenschutz')->name('datenschutz');
Route::get('api/demo', 'Test\JsonDemoController@index')->name('demo.api.json');
Route::middleware('auth:api')->group(function() {
    Route::namespace('Web')->name('.web')->prefix('web/v1')->group(function () {
        Route::get('{user}/{device}', 'WebAccessController@respond')->name('webaccess');
    });
});
Auth::routes(['verify' => true]);
Route::group(['middleware' => ['verified']], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::middleware('can:manage-vspot')->group(function () {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
    });
    Route::middleware('can:manage-users')->group(function () {
        Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
            Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            Route::get('registrations', 'UsersController@indexRegistrations')->name('users.unverified');
        });
    });
    Route::middleware('can:manage-signage')->group(function () {
        Route::resource('devices', 'DeviceController', ['except' => ['show']]);
        Route::resource('channels', 'ChannelController', ['except' => ['show']]);
        Route::resource('channels.screens', 'ScreenController', ['except' => ['show']]);
        Route::get('channels/{channel}/screens/{screen}/content/edit', 'ScreenController@editContent')->name('channels.screens.content.edit');
        Route::get('channels/{channel}/screens/{screen}/content/update', 'ScreenController@updateContent')->name('channels.screens.content.update');
    });
    Route::middleware('can:run-tests')->group(function () {
        Route::namespace('Test')->name('test.')->prefix('test')->group(function () {
            Route::get('email', 'TestFrontendController@email')->name('test-email');
            Route::prefix('qrcode')->group(function () {
                Route::get('email', 'TestQRCodeController@email')->name('test-qr-email');
                Route::get('link', 'TestQRCodeController@link')->name('test-qr-link');
                Route::get('phone', 'TestQRCodeController@phone')->name('test-qr-phone');
            });
        });
    });
});
