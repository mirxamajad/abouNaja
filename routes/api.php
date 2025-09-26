<?php

use Illuminate\Support\Facades\Route;

// Project-level API routes (kept minimal). Module routes are loaded by their ServiceProviders.
Route::get('/health', fn () => response()->json(['status' => 'ok']));
