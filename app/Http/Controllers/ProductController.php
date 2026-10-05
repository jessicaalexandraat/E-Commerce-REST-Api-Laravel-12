<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{



/**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Listar todos los productos",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="Catálogo de productos devuelto con éxito"
     *     )
     * )
     */
    // Ver catálogo completo
    public function index()
    {

    
        return response()->json(Product::all());


    }

    // Crear un producto
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json([
            'message' => 'Producto creado con éxito',
            'product' => $product
        ], 201);
    }

    // Ver un solo producto
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product);
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $product->update($request->all());
        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'product' => $product
        ]);
    }

    // Eliminar producto
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}