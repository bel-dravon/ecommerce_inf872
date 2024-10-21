<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            margin-bottom: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .header .company-info {
            text-align: right;
        }
        .company-info, .client-info {
            font-size: 14px;
            color: #555;
        }
        .client-info {
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .total-section {
            text-align: right;
            margin-top: 30px;
        }
        .total-section h3 {
            margin: 0;
        }
        .thanks {
            margin-top: 50px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="company-info">
                <h2>Tu Empresa S.A.</h2>
                <p>
                    Dirección de la Empresa<br>
                    Teléfono: (000) 123-4567<br>
                    Email: info@tuempresa.com
                </p>
            </div>
        </div>

        <!-- Cliente Information -->
        <div class="client-info">
            <h3>Factura para:</h3>
            <p>
                <strong>Nombre del Cliente:</strong> {{ $order->user->name }}<br>
                <strong>Email:</strong> {{ $order->user->email }}<br>
                <strong>Fecha de Factura:</strong> {{ $order->created_at->format('d-m-Y') }}
            </p>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <h3>Detalles del Pedido #{{ $order->id }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <h3>Total a Pagar: ${{ number_format($order->orderItems->sum(function($item) {
                return $item->price * $item->quantity;
            }), 2) }}</h3>
        </div>

        <!-- Thank You Message -->
        <div class="thanks">
            <p>Gracias por su compra. Esperamos volver a verlo pronto.</p>
        </div>
    </div>
</body>
</html>
