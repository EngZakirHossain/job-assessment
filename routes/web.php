<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::redirect('', '/dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('sales')->group(function () {
    Route::get('product/{id}/price', [SaleController::class, 'getProductPrice']);
    Route::get('trash', [SaleController::class, 'trash'])->name('sales.trash');
    Route::post('{sale}/restore', [SaleController::class, 'restore'])->name('sales.restore');
    Route::delete('{sale}/force-delete', [SaleController::class, 'forceDelete'])->name('sales.forceDelete');

});

Route::resource('sales', SaleController::class);
