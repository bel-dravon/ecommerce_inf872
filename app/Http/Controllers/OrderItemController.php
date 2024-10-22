<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        return view('order_items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        OrderItem::create($validatedData);

        return redirect()->route('order_items.index')->with('success', 'Order item created successfully.');
    }

    public function show(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('order_items.show', compact('orderItem'));
    }

    public function edit(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('order_items.edit', compact('orderItem'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($validatedData);

        return redirect()->route('order_items.index')->with('success', 'Order item updated successfully.');
    }

    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('order_items.index')->with('success', 'Order item deleted successfully.');
    }

    public function generateInvoice(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $order = $orderItem->order;

        $order->load('user', 'orderItems.product');

        $pdf = PDF::loadView('order_items.invoice', compact('order'));

        return $pdf->stream('factura_orden_' . $order->id . '.pdf');
    }

    public function editClient(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $orderItem->quantity = $request->quantity;
        $orderItem->save();

        // Recalcular el total de la orden
        $order = $orderItem->order;
        $order->updateTotals();

        return redirect()->back()->with('success', 'Cantidad actualizada correctamente');
    }
}