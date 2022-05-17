<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptainController;
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

Route::get('/', function () {
    return view('welcome');
});

//Route group for Captain.
Route::group(['prefix' => 'captain', ['middleware' => 'web']], function () {

    Route::get('/captains', [CaptainController::class, 'captains']);
});
