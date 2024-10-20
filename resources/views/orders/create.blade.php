@extends('layouts.app')

@section('content')
<h1>Crear Orden</h1>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <label>Usuario ID:</label>
    <input type="number" name="user_id" required>

    <label>Precio Total:</label>
    <input type="text" name="total_price" required>

    <label>Estado:</label>
    <select name="status" required>
        <option value="pendiente">Pendiente</option>
        <option value="completo">Completo</option>
        <option value="cancelado">Cancelado</option>
    </select>

    <button type="submit">Crear Orden</button>
</form>
@endsection