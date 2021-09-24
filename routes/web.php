<?php
Route::get('/', function () {
    return view('frontend.pages.front');
});
Auth::routes();
Route::get('/home', function() {
    $data['user'] = Auth::user();
    return view('backend.dashboard', $data);
})->name('home')->middleware('auth');
