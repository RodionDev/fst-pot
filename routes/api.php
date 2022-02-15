<?php
use Illuminate\Http\Request;
Route::middleware('auth:api')->group(function() {
    Route::namespace('Api')->name('api.')->prefix('v1')->group(function () {
        Route::get('{user}/{device}', 'ApiAccessController@respond_v1')->name('access_v1');
    });
});
