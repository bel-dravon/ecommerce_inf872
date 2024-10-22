<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function myOrders()
    {
        $user = auth()->user();
        $orders = $user->orders;
        return view('orders.my-orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pendiente,completo,cancelado',
        ]);

        Order::create($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pendiente,completo,cancelado',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function generatePDF($id)
    {
        $order = Order::findOrFail($id); 
        $pdf = PDF::loadView('orders.invoice', compact('order'));
        return $pdf->stream('factura_orden_' . $order->id . '.pdf');
    }

    public function simulatePayment($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completo';
        $order->save();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pago simulado exitosamente. El estado de la orden ha sido actualizado a completado.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelado';
        $order->save();

        return redirect()->route('orders.show', $order->id)
            ->with('info', 'La orden ha sido cancelada.');
    }
}
