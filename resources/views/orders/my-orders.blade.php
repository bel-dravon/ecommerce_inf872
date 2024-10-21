@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')
<h1 class="mb-4">Mis Pedidos</h1>

@if($orders->isEmpty())
    <p>No tienes pedidos aún.</p>
@else
    <div class="list-group">
        @foreach($orders as $order)
            <a href="{{ route('orders.show', $order->id) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Orden</h5>
                    <small>{{ $order->created_at->format('d/m/Y') }}</small>
                </div>
                <p class="mb-1">Total: ${{ number_format($order->total_price, 2) }}</p>
                <small>Estado: {{ ucfirst($order->status) }}</small>
            </a>
        @endforeach
    </div>
@endif
@endsection