<?php

use App\Http\Controllers\FormController;
use App\Http\Middleware\DeviceIsReader;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'index'])->middleware(DeviceIsReader::class);
