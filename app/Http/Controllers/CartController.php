<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $user = auth()->user();
        $order = Order::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'pendiente'],
            ['total_price' => 0]
        );

        $orderItem = OrderItem::updateOrCreate(
            ['order_id' => $order->id, 'product_id' => $product->id],
            ['quantity' => $request->quantity, 'price' => $product->price]
        );

        $this->updateOrderTotal($order);
        return redirect()->route('dashboard')->with('success', 'Producto añadido al carrito');
    }

    private function updateOrderTotal(Order $order)
    {
        $total = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order->update(['total_price' => $total]);
    }

    // Otros métodos para ver el carrito, actualizar cantidades, eliminar items, etc.
}