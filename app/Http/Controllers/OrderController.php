<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Admin.edit')->only('edit,update');
        $this->middleware('can:Admin.index')->only('index');
        $this->middleware('can:Admin.destroy')->only('destroy');
    }

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

    public function processPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Validar que la orden esté pendiente
        if ($order->status !== 'pendiente') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Esta orden no puede ser procesada.');
        }
    
        // Validar el método de pago
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,cash'
        ]);
    
        // Simular procesamiento del pago (2 segundos)
        sleep(2);
        
        // Actualizar el estado de la orden
        $order->status = 'completo';
        $order->save();
    
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pago procesado exitosamente.');
    }
    
    public function showPayment($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->status !== 'pendiente') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Esta orden no puede ser pagada.');
        }
    
        return view('orders.payment', compact('order'));
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
