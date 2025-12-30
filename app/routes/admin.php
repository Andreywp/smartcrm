<?php

use App\Http\Controllers\Admin\AdminTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])
        ->name('tickets.index');
});
