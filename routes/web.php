<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('events', \App\Http\Controllers\EventController::class);
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
Route::put('events/{id}/resize', [\App\Http\Controllers\EventController::class, 'resizeEvent'])->name('resize-event');
Route::get('refetchEvents', [\App\Http\Controllers\EventController::class, 'refetchEvents'])->name('refetch-events');
Route::put('refetchEvents', [\App\Http\Controllers\EventController::class, 'refetchEvents'])->name('refetch-events');
