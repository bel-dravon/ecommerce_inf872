<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Admin.index')->only('index');
        $this->middleware('can:Admin.destroy')->only('destroy');
        $this->middleware('can:Admin.edit')->only('edit,update');
    }

    public function index()
    {
        $orderItems = OrderItem::all();
        return view('order_items.index', compact('orderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('order_items.show', compact('orderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('order_items.edit', compact('orderItem'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
}
