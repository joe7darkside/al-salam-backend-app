<?php

use App\Http\Controllers\AppTokenController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BillController;
use App\Http\Controllers\CaptainAuthController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\API\InvitationController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\VisaCardController;
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



Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::group(['prefix' => 'user', 'middleware' => ['assign.guard:api', 'jwt.auth']], function () {

    Route::put('appToken/update', [AppTokenController::class, 'update']);
    Route::get('/info', [UserController::class, 'getUserInfo']);
    Route::put('/update', [UserController::class, 'update']);


    // Invitations Routes
    Route::group(['prefix' => 'visaCard'], function () {

        Route::get('/get', [VisaCardController::class, 'get']);
        Route::post('/add', [VisaCardController::class, 'add']);
        Route::delete('/delete/{id}', [VisaCardController::class, 'delete']);
    });

    // Invitations Routes
    Route::group(['prefix' => 'invitation'], function () {

        Route::post('/add', [InvitationController::class, 'addInvitation']);
        Route::get('/get', [InvitationController::class, 'getUserInvitaions']);
    });
    Route::group(['prefix' => 'trip'], function () {

        Route::get('/history', [TripController::class, 'userTripsHistory']);
        Route::post('/add', [TripController::class, 'addTrip']);
        Route::post('/pick-up', [TripController::class, 'addPickUp']);
        Route::post('/drop-of', [TripController::class, 'addDropOf']);
        Route::get('/pre-trips', [TripController::class, 'getUserPreTrip']);
        Route::put('/add-cost', [TripController::class, 'addCost']);
        Route::post('/add-trip', [TripController::class, 'orderTrip']);
        Route::get('/captain-details/{id}', [TripController::class, 'getCaptainDetails']);
        // Route::get('/trips/{id}', [CaptainController::class, 'getCaptainTrips']);
    });


    Route::group(['prefix' => 'bill'], function () {
        Route::get('/get', [BillController::class, 'getUserBills']);
        Route::get('/monthly-bills', [BillController::class, 'getMonthlyBills']);
    });
});

// Route group for Registering and login Captains. 

Route::group([
    'prefix' => 'captain/auth'
], function () {
    Route::post('/register', [CaptainAuthController::class, 'register']);
    Route::post('/login', [CaptainAuthController::class, 'login']);
});

Route::group(['prefix' => 'captain', 'middleware' => ['assign.guard:captain', 'jwt.auth']], function () {
    Route::get('/trips', [CaptainController::class, 'captainTrips']);
    Route::post('/logout', [CaptainAuthController::class, 'logout']);
    Route::post('/refresh', [CaptainAuthController::class, 'refresh']);
    Route::post('/me', [CaptainAuthController::class, 'me']);
});
// Route::post('appToken/store', [AppTokenController::class, 'store']);


