{{-- resources/views/orders/payment.blade.php --}}
@extends('layouts.app')

@section('title', 'Procesar Pago')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Procesar Pago - Orden #{{ $order->id }}</h4>
                </div>
                
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Resumen del Pedido:</h5>
                        <p><strong>Total a Pagar:</strong> ${{ number_format($order->total_price, 2) }}</p>
                    </div>

                    <form action="{{ route('orders.processPayment', $order->id) }}" method="POST" id="payment-form">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Método de Pago:</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Seleccione un método de pago</option>
                                <option value="credit_card">Tarjeta de Crédito</option>
                                <option value="paypal">PayPal</option>
                                <option value="cash">Contra reembolso</option>
                                <option value="cash">Trasferencia bancaria directa</option>
                                <option value="cash">Pago QR</option>
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                Procesar Pago
                            </button>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('payment-form').addEventListener('submit', function(e) {
    const submitButton = document.getElementById('submit-button');
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';
});
</script>
@endpush
@endsection