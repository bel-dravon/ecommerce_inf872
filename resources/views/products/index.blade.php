@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Catálogo de Productos</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-4x text-secondary"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0 text-primary">${{ number_format($product->price, 2) }}</span>
                        <span class="badge bg-secondary">Stock: {{ $product->stock }}</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-grid">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>Ver detalles
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection