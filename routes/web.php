<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentEventController;
use App\Models\ShipmentEvent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware('adminAuth')->group(function(){

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
      })->name('dashboard');

    //Shipment Events
    Route::get('/shipment-event/{id}', [ShipmentEventController::class, 'index'])->name('shipment-event.index');
    Route::get('/shipment-event/create/{id}', [ShipmentEventController::class, 'create'])->name('shipment-event.create');
    Route::post('/shipment-event/{id}', [ShipmentEventController::class,'store'])->name('shipment-event.store');
    Route::get('/shipment-event/edit/{id}', [ShipmentEventController::class, 'edit'])->name('shipment-event.edit');
    Route::patch('/shipment-event/{id}', [ShipmentEventController::class, 'update'])->name('shipment-event.update');
    Route::delete('/shipment-event/{id}', [ShipmentEventController::class, 'destroy'])->name('shipment-event.destroy');

    //Customer
    Route::post('/search-customers',[CustomerController::class, 'search'])->name('customer.search');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class,'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    //Shipment
    Route::post('/search-shipments',[ShipmentController::class, 'search'])->name('shipment.search');
    Route::get('/shipment', [ShipmentController::class, 'index'])->name('admin.dashboard');
    Route::get('/shipment/create', [ShipmentController::class, 'create'])->name('shipment.create');
    Route::post('/shipment', [ShipmentController::class,'store'])->name('shipment.store');
    // Route::get('/shipment/{id}', [ShipmentController::class,'show'])->name('shipment.show');
    Route::get('/shipment/edit/{id}', [ShipmentController::class, 'edit'])->name('shipment.edit');
    Route::put('/shipment/{id}', [ShipmentController::class, 'update'])->name('shipment.update');
    Route::delete('/shipment/{id}', [ShipmentController::class, 'destroy'])->name('shipment.destroy');
});

/**Super Admin routes **/
Route::middleware('superAdminAuth')->prefix('superAdmin')->group(function(){
    Route::get('/manage', [AdminController::class, 'index'])->name('superadmin.dashboard');
});

Route::get('/tracking', [ShipmentController::class, 'track'])->name('shipment.track');
Route::post('/tracking', [ShipmentController::class, 'show'])->name('shipment.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
