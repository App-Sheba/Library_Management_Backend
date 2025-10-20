<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // ✅ Role & Permission CRUD
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    // ✅ Protected routes by role
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin']);
    })->middleware('role:admin');

    // ✅ Protected routes by permission
    Route::get('/report', function () {
        return response()->json(['message' => 'You can view report']);
    })->middleware('permission:view-report');
    
});
