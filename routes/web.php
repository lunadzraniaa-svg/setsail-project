<?php

use App\Http\Controllers\GadgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('gadgets.index'));
Route::resource('gadgets', GadgetController::class);
