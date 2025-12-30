<?php

use App\Http\Controllers\Admin\AdminTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])
        ->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])
        ->name('tickets.show');

    Route::patch('/tickets/{ticket}', [AdminTicketController::class, 'update'])
        ->name('tickets.update');

});
