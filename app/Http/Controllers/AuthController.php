<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Registrar un nuevo usuario
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    // Iniciar sesión y devolver el Token JWT
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return $this->respondWithToken($token);
    }

    // Obtener información del usuario con la sesión activa
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    // Cerrar sesión
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Sesión cerrada exitosamente']);
    }

    // Formato de respuesta con el token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }
}