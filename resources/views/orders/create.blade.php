@extends('layouts.app')

@section('title', 'Crear Orden')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">
                        <i class="fas fa-plus-circle mr-2"></i> Crear Nueva Orden
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

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">
                                <i class="fas fa-user mr-1"></i> Usuario ID
                            </label>
                            <input type="number" class="form-control @error('user_id') is-invalid @enderror"
                                id="user_id" name="user_id" value="{{ old('user_id') }}" required>
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
                                    id="total_price" name="total_price" value="{{ old('total_price') }}" required>
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
                                <option value="pendiente" {{ old('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completo" {{ old('status') == 'completo' ? 'selected' : '' }}>Completo</option>
                                <option value="cancelado" {{ old('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Crear Orden
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