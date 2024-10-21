@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                            <i class="fas fa-image fa-5x text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <h1 class="mb-3">{{ $product->name }}</h1>
                    <p class="lead flex-grow-1">{{ $product->description }}</p>
                    <div class="mb-4">
                        <h2 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h2>
                        <small class="text-muted">Precio unitario</small>
                    </div>
                    <div class="mb-4">
                        <h5 class="mb-2">Stock disponible: <span class="badge bg-secondary">{{ $product->stock }}</span></h5>
                    </div>
                    <form action="{{ route('cart.add', $product) }}" method="POST" style="width: 400px; margin: 0">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-cart-plus me-2"></i>Agregar al Carrito
                            </button>
                        </div>
                    </form>
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
    .btn-primary {
        border-radius: 30px;
    }
</style>
@endsection