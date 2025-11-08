<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    //get authenticate user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // ✅ Role & Permission CRUD
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('publishers', PublisherController::class);

    // ✅ Protected routes by role
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin']);
    })->middleware('role:admin');

    // ✅ Protected routes by permission
    Route::get('/report', function () {
        return response()->json(['message' => 'You can view report']);
    })->middleware('permission:view-report');
});
