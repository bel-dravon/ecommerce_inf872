@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">

        <div class="card-body">
            <!-- Información del Cliente -->
            <h5 class="mb-4">Información del Cliente</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nombre del Cliente:</th>
                        <td>{{ $orderItem->order->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email del Cliente:</th>
                        <td>{{ $orderItem->order->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Fecha del Pedido:</th>
                        <td>{{ $orderItem->order->created_at->format('d-m-Y') }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Información del Producto -->
            <h5 class="mt-5 mb-4">Detalles del Producto</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $orderItem->product->name }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>${{ number_format($orderItem->price, 2) }}</td>
                        <td>${{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Información de Totales -->
            <div class="row mt-5">
                <div class="col-6 offset-6">
                    <table class="table">
                        <tr>
                            <th>Total a Pagar:</th>
                            <td>${{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('order_items.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('order_items.edit', $orderItem->id) }}" class="btn btn-warning">Editar Pedido</a>
        </div>
    </div>
</div>
@endsection
