<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;

Route::redirect('', '/dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::middleware(['auth'])->group(function() {
    Route::resource('suppliers', SupplierController::class);
    Route::get('suppliers-trash', [SupplierController::class,'trash'])->name('suppliers.trash');
    Route::post('suppliers/{id}/restore', [SupplierController::class,'restore'])->name('suppliers.restore');
    Route::delete('suppliers/{id}/force-delete', [SupplierController::class,'forceDelete'])->name('suppliers.forceDelete');

    // Route::resource('fabrics', FabricController::class);
    // Route::get('fabrics-trash', [FabricController::class,'trash'])->name('fabrics.trash');
    // Route::post('fabrics/{id}/restore', [FabricController::class,'restore'])->name('fabrics.restore');
    // Route::delete('fabrics/{id}/force-delete', [FabricController::class,'forceDelete'])->name('fabrics.forceDelete');

    // Route::resource('fabric-stocks', FabricStockController::class)->only(['create','store','index']);
    // Route::post('notes/{type}/{id}', [NoteController::class,'store'])->name('notes.store');

    // Route::get('fabrics/{fabric}/barcode/print', [FabricController::class,'printBarcode'])->name('fabrics.printBarcode');
// });
