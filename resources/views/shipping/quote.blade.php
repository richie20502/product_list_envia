<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizaciones de Envío</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Cotizaciones de Envío</h1>

        @if(isset($quotes['data']) && count($quotes['data']) > 0)
            <table class="w-full bg-white rounded-lg shadow-md p-6">
                <thead>
                    <tr>
                        <th class="text-left font-bold">Transportista</th>
                        <th class="text-left font-bold">Servicio</th>
                        <th class="text-left font-bold">Estimación de Entrega</th>
                        <th class="text-left font-bold">Costo Total</th>
                        <th class="text-left font-bold">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotes['data'] as $quote)
                        <tr>
                            <td class="py-4">{{ $quote['carrierDescription'] }}</td>
                            <td class="py-4">{{ $quote['serviceDescription'] }}</td>
                            <td class="py-4">{{ $quote['deliveryEstimate'] }} ({{ $quote['deliveryDate']['date'] }})</td>
                            <td class="py-4">${{ number_format($quote['totalPrice'], 2) }} {{ $quote['currency'] }}</td>
                            <td class="py-4">
                                <form action="{{ route('shipping.generate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="carrier" value="{{ $quote['carrier'] }}">
                                    <input type="hidden" name="service" value="{{ $quote['service'] }}">
                                    <input type="hidden" name="totalPrice" value="{{ $quote['totalPrice'] }}">
                                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Seleccionar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">No se encontraron cotizaciones disponibles.</span>
            </div>
        @endif
    </div>
</body>
</html>
