<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tutor Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
