<?php
declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminPromotionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quick-view/{id}', [HomeController::class, 'quickView'])->name('quick-view');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class)->except(['create', 'show']);
    Route::resource('promotions', AdminPromotionController::class)->except(['show']);
});