<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Orden #{{ $order->id }}</title>
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
        .company-logo {
            max-width: 150px;
        }
        .company-info {
            text-align: right;
            font-size: 14px;
            color: #555;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details, .client-info {
            margin-bottom: 30px;
            font-size: 14px;
            color: #555;
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

        <div class="header">
        <img src="https://cdn.pixabay.com/photo/2016/10/10/14/46/icon-1728552_1280.jpg" alt="Logo de la Empresa" class="company-logo" style="display: block;">
            <div class="company-info">
                <h2>Nombre de tu Empresa</h2>
                <p>
                    Dirección de la Empresa<br>
                    Ciudad, Estado, Código Postal<br>
                    Email: contacto@tuempresa.com | Teléfono: (123) 456-7890
                </p>
            </div>
        </div>

        <div class="invoice-header">
            <h2>Factura</h2>
        </div>

        <div class="client-info">
            <h3>Detalles de la Factura</h3>
            <p><strong>Cliente:</strong> {{ $order->user->name }}</p>
            <p><strong>Dirección:</strong> {{ $order->user->address }}</p>
            <p><strong>Fecha de la Orden:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Número de Orden:</strong> {{ $order->id }}</p>
            <p><strong>Método de Pago:</strong> {{ $order->payment_method }}</p>
        </div>

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

        <div class="total-section">
            <h3>Total a Pagar: ${{ number_format($order->total_price, 2) }}</h3>
        </div>

        <div class="thanks">
            <p>Gracias por su compra. Esperamos volver a verlo pronto.</p>
        </div>

    </div>

</body>
</html>
