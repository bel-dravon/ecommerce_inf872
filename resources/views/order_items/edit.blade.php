@extends('layouts.app')

@section('content')
<h1>Editar artículo de pedido</h1>
<form action="{{ route('order_items.update', $orderItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Orden ID:</label>
    <input type="number" name="order_id" value="{{ $orderItem->order_id }}" required>

    <label>Producto ID:</label>
    <input type="number" name="product_id" value="{{ $orderItem->product_id }}" required>

    <label>Cantidad:</label>
    <input type="number" name="quantity" value="{{ $orderItem->quantity }}" required>

    <label>Precio:</label>
    <input type="text" name="price" value="{{ $orderItem->price }}" required>

    <button type="submit">Actualizar artículo </button>
</form>
@endsection