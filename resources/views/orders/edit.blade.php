@extends('layouts.app')

@section('title', 'Editar Orden')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h1 class="mb-0">
                        <i class="fas fa-edit mr-2"></i> Editar Orden: {{ $order->id }}
                    </h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_id" class="form-label">
                                <i class="fas fa-user mr-1"></i> Usuario ID
                            </label>
                            <input type="number" class="form-control @error('user_id') is-invalid @enderror" 
                                   id="user_id" name="user_id" value="{{ old('user_id', $order->user_id) }}" required>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_price" class="form-label">
                                <i class="fas fa-dollar-sign mr-1"></i> Precio Total
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('total_price') is-invalid @enderror" 
                                       id="total_price" name="total_price" value="{{ old('total_price', $order->total_price) }}" required>
                            </div>
                            @error('total_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle mr-1"></i> Estado
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pendiente" {{ old('status', $order->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completo" {{ old('status', $order->status) == 'completo' ? 'selected' : '' }}>Completo</option>
                                <option value="cancelado" {{ old('status', $order->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save mr-1"></i> Actualizar Orden
                            </button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 15px;
    }
    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-warning {
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-warning:hover {
        color: #212529;
        background-color: #e0a800;
        border-color: #d39e00;
    }
</style>
@endsection
