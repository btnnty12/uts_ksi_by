<?php

use Illuminate\Support\Facades\Route;

// Public routes - redirect to Filament admin panel
Route::get('/', function () {
    return redirect('/admin');
});
