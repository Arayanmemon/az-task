<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Package;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $packages = Package::all();
    return view('dashboard', ['packages' => $packages]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stripe Routes
    Route::get('/buy/{package}', [PaymentController::class, 'index'])->name('stripe');
    Route::post('/pay', [PaymentController::class, 'checkout'])->name('checkout');
});


// Goal Page
Route::get('/goal', function(){
    $user = auth()->user();
    if($user->paid === 0){
        return back();
    }
    return('Goal Achieved');
})->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'verified', Admin::class])->group(function(){
    Route::get('/admindashboard', [PackageController::class, 'index'])->name('admin.dashboard');
    Route::get('/createpackage', [PackageController::class, 'create'])->name('admin.create');
    Route::post('/createpackage', [PackageController::class, 'store'])->name('admin.store');
    Route::get('/editpackage/{package}', [PackageController::class, 'edit'])->name('admin.edit');
    Route::patch('/editpackage/{package}', [PackageController::class, 'update'])->name('admin.update');
    Route::delete('/deletepackage/{package}', [PackageController::class, 'destroy'])->name('admin.destroy');
});

require __DIR__.'/auth.php';
