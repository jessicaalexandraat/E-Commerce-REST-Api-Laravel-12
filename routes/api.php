<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

// Autenticación pública
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Productos públicos (cualquiera puede ver el catálogo)
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

// Rutas protegidas con Token JWT
Route::middleware('auth:api')->group(function () {
    // Autenticación
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Gestión de Productos (Crear, Editar, Eliminar)
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    // Gestión de Órdenes
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{id}', [OrderController::class, 'show']);

    // Pasarela de Pagos (Stripe)
    Route::post('payments/process', [PaymentController::class, 'processPayment']);
});