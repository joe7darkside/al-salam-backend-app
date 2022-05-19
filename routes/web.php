<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
// use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



//TODO: Add ['middleware' => 'auth'] to the route group 

//* Routes for UserController
Route::group(['prefix' => 'users'], function () {

    Route::get('/overview', [UserController::class, 'getUsers'])->name('users.overView');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/profile/{id}', [UserController::class, 'userProfile'])->name('users.profile');
    Route::get('/send/{id}', [UserController::class, 'sendNotification'])->name('users.send');
});


Route::group(['prefix' => 'bills'], function () {
    Route::get('/overview', [BillController::class, 'getBills'])->name('bills.overView');
    Route::get('/categorized-bills/{category}', [BillController::class, 'getCategorizedBills'])->name('bills.categorized');
    Route::get('/paymentStatus/{Status}', [BillController::class, 'paymentStatusBills'])->name('bills.paymentStatus');
    Route::get('/statusSearch/{Status}', [BillController::class, 'statusSearch'])->name('bills.statusSearch');
    Route::get('/category-search/{category}', [BillController::class, 'categorizedSearch'])->name('bills.category.search');
    Route::get('/search', [BillController::class, 'search'])->name('bills.search');
});

Route::group(['prefix' => 'trips'], function () {
    Route::get('/overview', [TripController::class, 'getTrips'])->name('trips.overView');
    Route::get('/categorized-tripss/{category}', [TripController::class, 'categorizedTrips'])->name('trips.category');
    Route::get('/search', [TripController::class, 'search'])->name('trips.search');
    Route::get('/category-search/{category}', [TripController::class, 'categorizedSearch'])->name('trips.category.search');
    // Route::get('/categorized-bills/{category}', [BillController::class, 'getCategorizedBills'])->name('bills.categorized');
    // Route::get('/paymentStatus/{Status}', [BillController::class, 'paymentStatusBills'])->name('bills.paymentStatus');
});









require __DIR__ . '/auth.php';
