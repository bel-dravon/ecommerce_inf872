@extends('layouts.app')

@section('content')
<h1>Edit Order</h1>
<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Usuario ID:</label>
    <input type="number" name="user_id" value="{{ $order->user_id }}" required>

    <label>Precio Total:</label>
    <input type="text" name="total_price" value="{{ $order->total_price }}" required>

    <label>Estado:</label>
    <select name="status" required>
        <option value="pendiente" {{ $order->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="completo" {{ $order->status == 'completo' ? 'selected' : '' }}>Completo</option>
        <option value="cancelado" {{ $order->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>

    <button type="submit">Actualizar Orden</button>
</form>
@endsection