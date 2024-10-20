@extends('layouts.app')

@section('title', 'Crear Artículo de Pedido')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">
                        <i class="fas fa-plus-circle mr-2"></i> Crear Nuevo Artículo de Pedido
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

                    <form action="{{ route('order_items.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="order_id" class="form-label">
                                <i class="fas fa-receipt mr-1"></i> Orden ID
                            </label>
                            <input type="number" class="form-control @error('order_id') is-invalid @enderror"
                                   id="order_id" name="order_id" value="{{ old('order_id') }}" required>
                            @error('order_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="product_id" class="form-label">
                                <i class="fas fa-box mr-1"></i> Producto ID
                            </label>
                            <input type="number" class="form-control @error('product_id') is-invalid @enderror"
                                   id="product_id" name="product_id" value="{{ old('product_id') }}" required>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">
                                <i class="fas fa-sort-numeric-up-alt mr-1"></i> Cantidad
                            </label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                   id="quantity" name="quantity" min="1" value="{{ old('quantity') }}" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign mr-1"></i> Precio
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Crear Artículo
                            </button>
                            <a href="{{ route('order_items.index') }}" class="btn btn-secondary">
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

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection
