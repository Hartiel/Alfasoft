<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Initial route redirect to list person
Route::get('/', function () {
    return redirect()->route('people.index');
});

// People routes
Route::resource('people', PersonController::class);

// Contacts routes
Route::resource('contacts', ContactController::class);
