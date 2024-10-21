@extends('layouts.app')

@section('title', 'Detalles de la Orden')

@section('content')
<h1 class="mb-4">Detalles de la Orden #{{ $order->id }}</h1>

<div class="row mb-4">
    <!-- Información de la Orden -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">Información de la Orden</div>
            <div class="card-body">
                <p><strong>ID de la Orden:</strong> {{ $order->id }}</p>
                <p><strong>Estado:</strong> 
                    @if($order->status === 'completed')
                        <span class="badge bg-success">Completada</span>
                    @elseif($order->status === 'pending')
                        <span class="badge bg-warning">Pendiente</span>
                    @else
                        <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                    @endif
                </p>
                <p><strong>Precio Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                <p><strong>Fecha de Creación:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Información del Usuario -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">Información del Cliente</div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Teléfono:</strong> {{ $order->user->phone ?? 'No proporcionado' }}</p>
                <p><strong>Dirección:</strong> {{ $order->shipping_address }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Lista de Productos -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">Productos en la Orden</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Resumen de Totales -->
<div class="row mb-4">
    <div class="col-md-6 offset-md-6">
        <div class="card">
            <div class="card-body">
                <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                <p><strong>Envío:</strong> ${{ number_format($order->shipping_cost, 2) }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Botones de acción -->
<div class="d-flex justify-content-between">
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver a la lista
    </a>

    <div>
        <a href="{{ route('orders.generatePDF', $order->id) }}" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Descargar PDF
        </a>
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar Orden
        </a>
    </div>
</div>
@endsection
