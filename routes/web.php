<?php

use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\BillController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CaptainAuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\BillController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/overview', [UserController::class, 'getUsers'])->name('users.overView');
// Route::get('/search', [UserController::class, 'search'])->name('users.search');
// Route::get('/profile/{id}', [UserController::class, 'userProfile'])->name('users.profile');

Route::group(['middleware' => 'auth',], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //* Routes for UserController 
    Route::group(['prefix' => 'users', 'middleware' => 'role:users,super'], function () {

        Route::get('/overview', [UserController::class, 'getUsers'])->name('users.overView');
        Route::get('/search', [UserController::class, 'search'])->name('users.search');
        Route::get('/profile/{id}', [UserController::class, 'userProfile'])->name('users.profile');
        Route::get('/send/{id}', [UserController::class, 'sendNotification'])->name('users.send');
        Route::delete('/delete', [UserController::class, 'destroy'])->name('users.delete');
    });

    //* Routes for BillController 
    Route::group(['prefix' => 'bills', 'middleware' => 'role:bills,super'], function () {
        Route::get('/overview', [BillController::class, 'get'])->name('bills.overView');
        Route::get('/search', [BillController::class, 'search'])->name('bills.search');
        Route::post('/add', [BillController::class, 'add'])->name('bills.add');
        Route::get('/edit/{id}', [BillController::class, 'edit'])->name('bills.edit');
        Route::put('/update/', [BillController::class, 'update'])->name('bills.update');
        Route::delete('/delete', [BillController::class, 'destroy'])->name('bills.delete');
        Route::get('/paymentStatus/{status}', [BillController::class, 'getPaymentStatusBills'])->name('bills.paymentStatus');
        Route::get('/statusSearch/{status}', [BillController::class, 'statusSearch'])->name('bills.statusSearch');

        // Route::get('/categorized-bills/{category}', [BillController::class, 'getCategorized'])->name('bills.categorized');
        // Route::get('/category-search/{category}', [BillController::class, 'categorizedSearch'])->name('bills.category.search');
    });

    //* Routes for TripController 
    Route::group(['prefix' => 'trips', 'middleware' => 'role:trips,super'], function () {
        Route::get('/overview', [TripController::class, 'getTrips'])->name('trips.overView');
        Route::get('/categorized-trips/{category}', [TripController::class, 'categorizedTrips'])->name('trips.category');
        Route::get('/search', [TripController::class, 'search'])->name('trips.search');
        Route::get('/category-search/{category}', [TripController::class, 'categorizedSearch'])->name('trips.category.search');
        Route::get('/info/{id}', [TripController::class, 'info'])->name('trips.show');
    });


    //* Routes for InvitationController 
    Route::group(['prefix' => 'invitations', 'middleware' => 'role:invitations,super'], function () {
        Route::get('/overview', [InvitationController::class, 'getInvitations'])->name('invitations.overView');
        Route::get('/categorized-invitations/{category}', [InvitationController::class, 'categorizedInvitations'])->name('invitations.category');
        Route::get('/search', [InvitationController::class, 'search'])->name('invitations.search');
        Route::get('/category-search/{category}', [InvitationController::class, 'categorizedSearch'])->name('invitations.category.search');
    });



    //* Routes for CaptainController 
    Route::group(['prefix' => 'captains', 'middleware' => 'role:captains,super'], function () {
        Route::post('/register', [CaptainAuthController::class, 'register'])->name('captains.register');
        Route::get('/overview', [CaptainController::class, 'getCaptains'])->name('captains.overView');
        // Route::get('/categorized-invitations/{category}', [CaptainController::class, 'categorizedInvitations'])->name('invitations.category');
        Route::get('/search', [CaptainController::class, 'search'])->name('captains.search');
        // Route::get('/category-search/{category}', [CaptainController::class, 'categorizedSearch'])->name('invitations.category.search');
        Route::get('/profile/{id}', [CaptainController::class, 'getCaptainProfile'])->name('captains.profile');
        Route::get('/edit/{id}', [CaptainController::class, 'editCaptain'])->name('captains.edit');
        Route::put('/update', [CaptainController::class, 'updateCaptain'])->name('captains.update');
        Route::delete('/delete', [CaptainController::class, 'destroy'])->name('captains.delete');
    });
    //* Routes for CaptainController 
    Route::group(['prefix' => 'users', 'middleware' => 'role:users,super'], function () {
        Route::post('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('users.edit');
        Route::put('/update', [UserController::class, 'updateUser'])->name('users.update');
    });


    //* Routes for NotificationsController 
    Route::group(['prefix' => 'notifications', 'middleware' => 'role:notifications,super'], function () {

        Route::post('/sendNotification', [NotificationController::class, 'UserNotification'])->name('notifications.user');
        Route::get('/overview', [NotificationController::class, 'index'])->name('notifications.overview');
        Route::get('/send', [NotificationController::class, 'send'])->name('notifications.send');
        Route::get('/search', [NotificationController::class, 'search'])->name('notifications.search');
        Route::get('/edit/{id}', [NotificationController::class, 'edit'])->name('notifications.edit');
        Route::get('/show/{id}', [NotificationController::class, 'show'])->name('notifications.show');
        Route::put('/update', [NotificationController::class, 'update'])->name('notifications.update');
        Route::post('/add/', [NotificationController::class, 'store'])->name('notifications.add');
        Route::delete('/delete', [NotificationController::class, 'destroy'])->name('notifications.delete');
    });




    //* Routes for AdminController 
    Route::group(['prefix' => 'admins', 'middleware' => 'role:super,super'], function () {
        Route::get('/overview', [AdminController::class, 'getAdmins'])->name('admins.overView');
        Route::post('/store', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/search', [AdminController::class, 'search'])->name('admins.search');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/update', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/delete', [AdminController::class, 'destroy'])->name('admins.delete');
        Route::post('/send', [AdminController::class, 'send'])->name('admins.send');
    });
});





require __DIR__ . '/auth.php';
