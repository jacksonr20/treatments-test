<?php

use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TreatmentController::class, 'index'])->name('treatments');

Route::post('/treatment-upload', [TreatmentController::class, 'upload'])->name('treatments.upload');
