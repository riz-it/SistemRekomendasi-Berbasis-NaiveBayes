<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\PagesController;
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

Route::get('/', [PagesController::class, 'login'])->name('login');
Route::post('/verified_login', [PagesController::class, 'verified_login']);
Route::get('/logout', [PagesController::class, 'logout']);

Route::group(['middleware' => ['auth']], function () {
    Route::get(
        '/dashboard',
        [PagesController::class, 'index']
    );

    Route::resource('data', DataController::class);

    Route::get(
        '/output',
        [OutputController::class, 'output']
    );

    Route::get(
        '/progress',
        [OutputController::class, 'progress']
    );

    Route::get(
        '/progress/{id}',
        [OutputController::class, 'progress']
    );

    Route::get(
        '/output/{id}',
        [OutputController::class, 'output']
    );
});
