@extends('layouts.app')

@section('content')
<h1>Crear artículo de pedido</h1>
<form action="{{ route('order_items.store') }}" method="POST">
    @csrf
    <label>Orden ID:</label>
    <input type="number" name="order_id" required>

    <label>Producto ID:</label>
    <input type="number" name="product_id" required>

    <label>Cantidad:</label>
    <input type="number" name="quantity" required>

    <label>Precio:</label>
    <input type="text" name="price" required>

    <button type="submit">Crear artículo</button>
</form>
@endsection