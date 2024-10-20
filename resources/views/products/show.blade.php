@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-image fa-5x text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h1 class="mb-4">{{ $product->name }}</h1>
                    <p class="lead mb-4">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h2>
                            <small class="text-muted">Precio unitario</small>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ $product->stock }}</h4>
                            <small class="text-muted">Unidades en stock</small>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i>Editar Producto
                        </a>
                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash-alt me-2"></i>Eliminar Producto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar el producto "{{ $product->name }}"? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 15px;
    }
    .btn-lg {
        border-radius: 30px;
    }
</style>
@endsection