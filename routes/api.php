<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisaCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api',], function () {

    Route::get('/user/cards', [UserController::class, 'getVisaCard']);
    Route::get('/user/info', [UserController::class, 'getUserInfo']);
    Route::post('/visa-card/create', [VisaCardController::class, 'addVisaCard']);
    Route::post('/invitation/create', [InvitationController::class, 'addInvitation']);
    Route::get('/user/invitaions', [InvitationController::class, 'getUserInvitaions']);
    Route::get('/user/trips', [TripController::class, 'getUserTrip']);
    Route::post('/trips/create', [TripController::class, 'addTrip']);
    Route::get('/bills/monthly-bills', [BillController::class, 'getMonthlyBills']);
    Route::get('/bills/user/bills', [BillController::class, 'getUserBills']);
    Route::post('/bills/create', [BillController::class, 'addUserBill']);

});
