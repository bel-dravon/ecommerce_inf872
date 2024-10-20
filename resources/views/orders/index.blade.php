@extends('layouts.app')

@section('content')
<h1>Orders</h1>
<a href="{{ route('orders.create') }}" >Crear Orden</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}">Ver</a>
                <a href="{{ route('orders.edit', $order->id) }}">Editar</a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection