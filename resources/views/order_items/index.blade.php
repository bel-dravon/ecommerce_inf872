@extends('layouts.app')

@section('content')
<h1>Order Items</h1>
<a href="{{ route('order_items.create') }}" class="btn btn-primary">Create Order Item</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Orden ID</th>
            <th>Producto ID</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $orderItem)
        <tr>
            <td>{{ $orderItem->id }}</td>
            <td>{{ $orderItem->order_id }}</td>
            <td>{{ $orderItem->product_id }}</td>
            <td>{{ $orderItem->quantity }}</td>
            <td>{{ $orderItem->price }}</td>
            <td>
                <a href="{{ route('order_items.show', $orderItem->id) }}">Ver</a>
                <a href="{{ route('order_items.edit', $orderItem->id) }}">Editar</a>
                <form action="{{ route('order_items.destroy', $orderItem->id) }}" method="POST" style="display:inline;">
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