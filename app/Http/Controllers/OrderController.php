<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Listar órdenes del usuario autenticado
    public function index()
    {
        $orders = Order::with('items.product', 'payment')
            ->where('user_id', auth('api')->id())
            ->get();

        return response()->json($orders);
    }

    // Crear una nueva orden y descontar stock
    public function store(StoreOrderRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $total = 0;
            $itemsToCreate = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'error' => "Stock insuficiente para el producto: {$product->name}"
                    ], 400);
                }

                $total += $product->price * $item['quantity'];
                $product->decrement('stock', $item['quantity']);

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ];
            }

            $order = Order::create([
                'user_id'      => auth('api')->id(),
                'total_amount' => $total,
                'status'       => 'pending',
            ]);

            foreach ($itemsToCreate as $itemData) {
                $order->items()->create($itemData);
            }

            return response()->json([
                'message' => 'Orden creada con éxito',
                'order'   => $order->load('items')
            ], 201);
        });
    }

    // Ver detalle de una orden
    public function show($id)
    {
        $order = Order::with('items.product', 'payment')
            ->where('user_id', auth('api')->id())
            ->find($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        return response()->json($order);
    }
}