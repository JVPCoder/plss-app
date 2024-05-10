<?php

use App\Http\Controllers\CallingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CallingController::class, 'index'])->name('calling.index');
Route::get('/create', [CallingController::class, 'create'])->name('calling.create');
Route::post('/', [CallingController::class, 'store'])->name('calling.store');
Route::get('/{calling}/edit', [CallingController::class, 'edit'])->name('calling.edit');
Route::put('/{calling}/update', [CallingController::class, 'update'])->name('calling.update');
Route::delete('/{calling}/destroy', [CallingController::class, 'destroy'])->name('calling.destroy');
