<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::get('/', function () {
    return view('welcome');
});
Route::prefix(  LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
    Route::prefix('dashboard')
    ->group(base_path('routes/backend.php'));

    Route::prefix('site')
    ->group(base_path('\routes\site.php'));
    require __DIR__.'/auth.php';
});


