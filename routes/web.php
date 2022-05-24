<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\View;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return View::make('dashboard.home.home');
    
});
Route::get('/overview', [UserController::class, 'getUsers'])->name('users.overView');
Route::get('/search', [UserController::class, 'search'])->name('users.search');
Route::get('/profile/{id}', [UserController::class, 'userProfile'])->name('users.profile');

Route::group(['middleware' => 'auth'], function () {


    //* Routes for UserController 
    Route::group(['prefix' => 'users'], function () {

        // Route::get('/overview', [UserController::class, 'getUsers'])->name('users.overView');
        // Route::get('/search', [UserController::class, 'search'])->name('users.search');
        // Route::get('/profile/{id}', [UserController::class, 'userProfile'])->name('users.profile');
        Route::get('/send/{id}', [UserController::class, 'sendNotification'])->name('users.send');
    });

    //* Routes for BillController 
    Route::group(['prefix' => 'bills'], function () {
        Route::get('/overview', [BillController::class, 'getBills'])->name('bills.overView');
        Route::get('/categorized-bills/{category}', [BillController::class, 'getCategorizedBills'])->name('bills.categorized');
        Route::get('/paymentStatus/{Status}', [BillController::class, 'paymentStatusBills'])->name('bills.paymentStatus');
        Route::get('/statusSearch/{Status}', [BillController::class, 'statusSearch'])->name('bills.statusSearch');
        Route::get('/category-search/{category}', [BillController::class, 'categorizedSearch'])->name('bills.category.search');
        Route::get('/search', [BillController::class, 'search'])->name('bills.search');
    });

    //* Routes for TripController 
    Route::group(['prefix' => 'trips'], function () {
        Route::get('/overview', [TripController::class, 'getTrips'])->name('trips.overView');
        Route::get('/categorized-tripss/{category}', [TripController::class, 'categorizedTrips'])->name('trips.category');
        Route::get('/search', [TripController::class, 'search'])->name('trips.search');
        Route::get('/category-search/{category}', [TripController::class, 'categorizedSearch'])->name('trips.category.search');
    });

    //* Routes for InvitationController 
    Route::group(['prefix' => 'invitations'], function () {
        Route::get('/overview', [InvitationController::class, 'getinvitations'])->name('invitations.overView');
        Route::get('/categorized-invitations/{category}', [InvitationController::class, 'categorizedInvitations'])->name('invitations.category');
        Route::get('/search', [InvitationController::class, 'search'])->name('invitations.search');
        Route::get('/category-search/{category}', [InvitationController::class, 'categorizedSearch'])->name('invitations.category.search');
    });



    //* Routes for CaptainController 
    Route::group(['prefix' => 'captains'], function () {
        Route::get('/overview', [CaptainController::class, 'getCaptains'])->name('captains.overView');
        Route::get('/categorized-invitations/{category}', [CaptainController::class, 'categorizedInvitations'])->name('invitations.category');
        Route::get('/search', [CaptainController::class, 'search'])->name('invitations.search');
        Route::get('/category-search/{category}', [CaptainController::class, 'categorizedSearch'])->name('invitations.category.search');
        Route::get('/profile/{id}', [CaptainController::class, 'getCaptainProfile'])->name('captains.profile');
    });
});

//* Routes for AdminController 
Route::group(['prefix' => 'admins'], function () {
    Route::get('/overview', [AdminController::class, 'getAdmins'])->name('admins.overView');
    Route::get('/categorized-admin/{category}', [AdminController::class, 'categorizedInvitations'])->name('invitations.category');
    Route::get('/search', [AdminController::class, 'search'])->name('invitations.search');
    Route::get('/category-search/{category}', [AdminController::class, 'categorizedSearch'])->name('invitations.category.search');
    Route::get('/profile/{id}', [AdminController::class, 'getAdminsProfile'])->name('admins.profile');
});



require __DIR__ . '/auth.php';
