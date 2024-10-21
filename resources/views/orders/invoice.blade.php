<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Orden #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 30px;
            background: #f9f9f9;
            color: #333;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .company-info {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .invoice-header {
            background: #0056b3;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-info {
            margin-bottom: 20px;
            padding: 15px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        }
        .invoice-info h3 {
            margin-top: 0;
        }
        .invoice-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        tfoot td {
            font-weight: bold;
            background: #f2f2f2;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #666;
        }
        .note {
            font-style: italic;
            margin-top: 10px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            header, footer {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Empresa" class="company-logo">
    <div class="company-info">
        <h1>Nombre de tu Empresa</h1>
        <p>Dirección de la Empresa</p>
        <p>Ciudad, Estado, Código Postal</p>
        <p>Email: contacto@tuempresa.com | Teléfono: (123) 456-7890</p>
    </div>
</header>

<div class="invoice-header">
    <h2>Factura</h2>
</div>

<div class="invoice-info">
    <h3>Detalles de la Factura</h3>
    <p><strong>Cliente:</strong> {{ $order->user->name }}</p>
    <p><strong>Dirección:</strong> {{ $order->user->address }}</p>
    <p><strong>Fecha de la Orden:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
    <p><strong>Número de Orden:</strong> {{ $order->id }}</p>
    <p><strong>Método de Pago:</strong> {{ $order->payment_method }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ number_format($item->price, 2) }}</td>
            <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="total"><strong>Total</strong></td>
            <td>${{ number_format($order->total_price, 2) }}</td>
        </tr>
    </tfoot>
</table>

<footer>
    <p>Gracias por tu compra. Si tienes alguna pregunta, no dudes en contactarnos.</p>
    <p class="note">Términos y condiciones aplican.</p>
</footer>

</body>
</html>
