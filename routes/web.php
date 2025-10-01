<?php

use App\Http\Controllers\FabricController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Redirect root to dashboard
Route::fallback(function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    // Suppliers
    Route::resource('suppliers', SupplierController::class);
    Route::get('suppliers-trash', [SupplierController::class, 'trash'])->name('suppliers.trash');
    Route::post('suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
    Route::delete('suppliers/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('suppliers.forceDelete');
    Route::get('/suppliers/{supplier}/json', [SupplierController::class, 'getSupplier'])->name('suppliers.get-json');

    // Fabrics
    Route::resource('fabrics', FabricController::class);
    Route::get('fabrics-trash', [FabricController::class, 'trash'])->name('fabrics.trash');
    Route::post('fabrics/{id}/restore', [FabricController::class, 'restore'])->name('fabrics.restore');
    Route::delete('fabrics/{id}/force-delete', [FabricController::class, 'forceDelete'])->name('fabrics.forceDelete');
    Route::get('/fabrics/{id}/barcode', [FabricController::class, 'barcode'])->name('fabrics.barcode');

});
