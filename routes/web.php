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
    Route::get('aktivierung', function() {
        $data['user'] = Auth::user();
        return view('frontend.pages.feedback.waiting_for_approval', $data);
    })->name('approval');
    Route::middleware(['approved'])->group(function () {
        Route::get('dashboard', function() {
            $data['user'] = Auth::user();
            return view('backend.dashboard', $data);
        })->name('dashboard');
        Route::middleware(['admin'])->group(function () {
            Route::namespace('Admin')->prefix('admin')->group(function () {
                Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            });
            Route::namespace('Test')->prefix('test')->group(function () {
                Route::get('email', 'TestFrontendController@email')->name('test-email');
            });
        });
    });
});
