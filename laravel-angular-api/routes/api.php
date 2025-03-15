<?php

// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);