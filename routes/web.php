<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\DataTables\CutomersDataTable;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\project\ProjectSupplierController;
use App\Http\Controllers\Project\QuotationController;
use App\Http\Controllers\SupplierController;

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

Route::prefix('app')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Media
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload/temp', [MediaController::class, 'temp_upload'])->name('media.upload.temp');
    Route::post('media/upload', [MediaController::class, 'store'])->name('media.store');

    Route::get('destinations', function(){
        return abort(500, 'Internal Server Error');
    })->name('destinations');

    /**
     * Pages Inside Settings
     */
    Route::prefix('settings')->group(function(){
        //
    });
});



require __DIR__.'/auth.php';
