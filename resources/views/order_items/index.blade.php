@extends('layouts.app')

@section('title', 'Gestión de Items de Orden')

@section('content')
<h1 class="mb-4">Items de Orden</h1>

<!-- Botón para crear un nuevo item de orden -->
<a href="{{ route('order_items.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus-circle mr-1"></i> Crear Item de Orden
</a>

<!-- Botón para descargar el reporte en PDF de la factura, ubicado fuera de la tabla -->
<a href="{{ route('order_items.generateInvoice', $orderItems->first()->id) }}" class="btn btn-success mb-3">
    <i class="fas fa-file-pdf mr-1"></i> Descargar Factura
</a>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Tabla de items de orden -->
<div class="table-responsive">
    <table class="table table-hover">
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
                <td>{{ $orderItem->product->name }}</td>
                <td>{{ $orderItem->quantity }}</td>
                <td>${{ number_format($orderItem->price, 2) }}</td>
                <td>
                    <a href="{{ route('order_items.show', $orderItem->id) }}" class="btn btn-info btn-sm" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('order_items.edit', $orderItem->id) }}" class="btn btn-warning btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('order_items.destroy', $orderItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este item de orden?')" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
