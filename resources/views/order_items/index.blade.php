@extends('layouts.app')

@section('title', 'Artículos de Pedido')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Artículos de Pedido</h1>
            <a href="{{ route('order_items.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus-circle mr-1"></i> Crear Nuevo Artículo de Pedido
            </a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->id }}</td>
                                <td>{{ $orderItem->order_id }}</td>
                                <td>{{ $orderItem->product_id }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>${{ number_format($orderItem->price, 2) }}</td>
                                <td>
                                    <a href="{{ route('order_items.show', $orderItem->id) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('order_items.edit', $orderItem->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('order_items.destroy', $orderItem->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este artículo de pedido?')" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
