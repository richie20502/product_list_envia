<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Cotización</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Detalle de Cotización</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Cotización ID: {{ $quotation['id'] }}</h2>
            <p class="mb-4"><strong>Estado:</strong> {{ $quotation['is_completed'] ? 'Completada' : 'Pendiente' }}</p>
            <p class="mb-4"><strong>Transportistas encontrados:</strong> {{ implode(', ', $quotation['quotation_scope']['found_carriers']) }}</p>
        </div>

        <h2 class="text-2xl font-semibold mb-4">Tarifas Disponibles</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($quotation['rates'] as $rate)
                <div class="bg-white shadow-md rounded-lg p-4 
                    @if (!$rate['total']) opacity-50 cursor-not-allowed @endif">
                    <h3 class="text-xl font-bold mb-2">{{ $rate['provider_name'] }}</h3>
                    <p><strong>Servicio:</strong> {{ $rate['provider_service_name'] }}</p>
                    <p><strong>Tipo:</strong> {{ $rate['rate_type'] ?? 'No especificado' }}</p>
                    <p><strong>Total:</strong> {{ $rate['total'] ? '$' . $rate['total'] : 'No disponible' }}</p>
                    <p><strong>Días de entrega:</strong> {{ $rate['days'] ?? 'No especificado' }}</p>
                    
                    @if (!$rate['success'] && !empty($rate['error_messages']) && count($rate['error_messages']) > 0)
                        <p class="text-red-500 font-semibold mt-2">Error: 
                            @foreach ($rate['error_messages'] as $error)
                                {{ $error['error_message'] }} 
                            @endforeach
                        </p>
                    @endif
                    @if ($rate['total'])
                        <form action="{{ route('zensara.rates.process') }}" method="POST" class="mt-4">
                            @csrf

                            <input type="hidden" id="products" name="products" value="{{ $requestData['products'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="total" name="total" value="{{ $requestData['total'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="name" name="name" value="{{ $requestData['name'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="company" name="company" value="{{ $requestData['company'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="email" name="email" value="{{ $requestData['email'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="phone" name="phone" value="{{ $requestData['phone'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="street" name="street" value="{{ $requestData['street'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="number" name="number" value="{{ $requestData['number'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="district" name="district" value="{{ $requestData['district'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="city" name="city" value="{{ $requestData['city'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="state" name="state" value="{{ $requestData['state'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="postalCode" name="postalCode" value="{{ $requestData['postalCode'] }}" class="w-full p-2 border rounded" readonly>
                            <input type="hidden" id="reference" name="reference" value="{{ $requestData['reference'] }}" class="w-full p-2 border rounded"readonly>
                            <input type="hidden" name="rate_id" value="{{ $rate['id'] }}" readonly>
                            <input type="hidden" name="quotation_id" value="{{ $quotation['id'] }}" readonly>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                Seleccionar Tarifa
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
