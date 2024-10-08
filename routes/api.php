<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AdminController;

// Contoh route API
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});



