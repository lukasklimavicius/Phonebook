<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', [\App\Http\Controllers\ContactController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [\App\Http\Controllers\ContactController::class, 'store']);
    Route::post('/share', [\App\Http\Controllers\SharedContactController::class, 'share']);
    Route::put('/update', [\App\Http\Controllers\ContactController::class, 'update']);
    Route::get('/delete/{contact}', [\App\Http\Controllers\ContactController::class, 'delete']);
    Route::get('/stop/{id}', [\App\Http\Controllers\SharedContactController::class, 'stopshare']);
    Route::get('/sharedByMe', [\App\Http\Controllers\SharedContactController::class, 'sharedByMe'])->name('sharedByMe');
    Route::get('/sharedToMe', [\App\Http\Controllers\SharedContactController::class, 'sharedToMe'])->name('sharedToMe');
});




require __DIR__.'/auth.php';
