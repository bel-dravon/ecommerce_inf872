@extends('layouts.app')

@section('title', 'Gestión de Órdenes')

@section('content')
<h1 class="mb-4">Gestión de Órdenes</h1>
<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus-circle mr-1"></i> Crear Orden
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
                <th>Usuario</th>
                <th>Precio Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta orden?')" title="Eliminar">
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