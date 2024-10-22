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
                        @if ($order->status === 'completed')
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal de confirmación de eliminación -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que quieres eliminar el producto "{{ $item->product->name }}" del
                                        pedido?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('order_items.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para editar cantidad -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                            Editar Cantidad - {{ $item->product->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('order_items.editClient', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="quantity{{ $item->id }}"
                                                    class="form-label">Cantidad:</label>
                                                <input type="number" class="form-control" id="quantity{{ $item->id }}"
                                                    name="quantity" value="{{ $item->quantity }}" min="1" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        @can('Admin.edit')
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
        @endcan
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Productos
        </a>
        <div>
            <a href="{{ route('orders.showPayment', $order->id) }}" class="btn btn-primary">
                <i class="fa fa-credit-card"></i> Procesar Pago
            </a>
            <a href="{{ route('orders.generatePDF', $order->id) }}" class="btn btn-success">
                <i class="fas fa-file-pdf"></i> Descargar Factuar
            </a>
            @can('Admin.edit')
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar Orden
                </a>
            @endcan
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Cancelar Orden
                </button>
            </form>
        </div>
    </div>
@endsection
