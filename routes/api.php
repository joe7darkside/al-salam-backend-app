<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CaptainAuthController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisaCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



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

Route::group(['middleware' => ['assign.guard:api', 'jwt.auth']], function () {
    Route::get('/user/cards', [UserController::class, 'getVisaCard']);
    Route::get('/user/info', [UserController::class, 'getUserInfo']);
    Route::post('/visa-card/create', [VisaCardController::class, 'addVisaCard']);
    Route::post('/invitation/create', [InvitationController::class, 'addInvitation']);
    Route::get('/user/invitaions', [InvitationController::class, 'getUserInvitaions']);
    Route::get('/user/trips', [TripController::class, 'getUserTrip']);
    Route::get('/user/pre-trips', [TripController::class, 'getUserPreTrip']);
    Route::post('/trips/add-preTrip', [TripController::class, 'addTrip']);
    Route::post('/trips/add-pick-up', [TripController::class, 'addPickUpPoint']);
    Route::post('/trips/add-drop-of', [TripController::class, 'addDropOfPoint']);
    Route::put('/trips/add-cost', [TripController::class, 'addCost']);
    Route::post('/trips/add-trip', [TripController::class, 'orderTrip']);
    Route::get('/trips/captain-details/{id}', [TripController::class, 'getCaptainDetails']);
    Route::get('/captain/trips/{id}', [CaptainController::class, 'getCaptainTrips']);
    Route::get('/bills/monthly-bills', [BillController::class, 'getMonthlyBills']);
    Route::get('/bills/user/bills', [BillController::class, 'getUserBills']);
    Route::post('/bills/create', [BillController::class, 'addUserBill']);
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


Route::post('captains/register', [CaptainAuthController::class, 'register'])->name('captains.register');
