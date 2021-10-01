<?php
View::composer('*', function($view){
    View::share('view_name', $view->getName());
});
Route::view('/', 'frontend.pages.primary.front')->name('front');
Route::view('/produkt', 'frontend.pages.primary.produkt')->name('produkt');
Route::view('/impressum', 'frontend.pages.secondary.impressum')->name('impressum');
Route::view('/datenschutz', 'frontend.pages.secondary.datenschutz')->name('datenschutz');
Auth::routes(['verify' => true]);
Route::group(['middleware' => ['verified']], function () {
    Route::get('/aktivierung', function() {
        $data['user'] = Auth::user();
        return view('frontend.pages.feedback.waiting_for_approval', $data);
    })->name('approval');
    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', function() {
            $data['user'] = Auth::user();
            return view('backend.dashboard', $data);
        })->name('dashboard');
    });
});
