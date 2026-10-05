<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="E-Commerce REST API Documentation",
 *      description="API RESTful para la gestión de productos, órdenes de compra y pagos con Stripe",
 *      @OA\Contact(
 *          email="admin@ecommerce.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url="http://127.0.0.1:8000",
 *      description="Servidor Principal de la API"
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="Ingrese el token JWT obtenido en el inicio de sesión con el formato 'Bearer {token}'"
 * )
 */
abstract class Controller
{
    //
}
