<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Bus\SeatingController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\RouteController;
use Illuminate\Http\Request;

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

// redirects
Route::get('/', function () {
    return redirect('app/dashboard');
})->name('home');

Route::get('app', function(){
    return redirect('app/dashboard');
})->name('app');

Route::get('dashboard', function(){
    return redirect('app/dashboard');
});

Route::prefix('app')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // helpers
    Route::get('/get-string-slug', function(Request $request){
        return response()->json(str()->slug($request->query('string')), 200);
    })->name('get-string-slug');
    
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Media
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload/temp', [MediaController::class, 'temp_upload'])->name('media.upload.temp');
    Route::post('media/upload', [MediaController::class, 'store'])->name('media.store');
    Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    Route::put('media/{media}', [MediaController::class, 'update'])->name('media.update');
    
    Route::resource('destinations', DestinationController::class);

    // routes
    Route::resource('routes', RouteController::class);
    
    // bus
    Route::resource('buses', BusController::class);
    Route::get('buses/{bus}/seating', [SeatingController::class, 'edit'])->name('buses.seating.edit');
    Route::put('buses/{bus}/seating', [SeatingController::class, 'update'])->name('buses.seating.update');


    // bookings
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');

    /**
     * Pages Inside Settings
     */
    Route::prefix('settings')->group(function(){
        //
    });
});



require __DIR__.'/auth.php';
