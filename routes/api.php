<?php

use App\Http\Controllers\Api\GadgetApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('gadgets', GadgetApiController::class)->names('api.gadgets');