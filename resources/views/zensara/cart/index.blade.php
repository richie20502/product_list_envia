<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Carrito de Compras Zensara</h1>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left font-bold">Producto</th>
                            <th class="text-left font-bold">Precio</th>
                            <th class="text-left font-bold">Cantidad</th>
                            <th class="text-left font-bold">Subtotal</th>
                            <th class="text-left font-bold">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $id => $details)
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <span class="font-bold">{{ $details['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4">${{ $details['price'] }}</td>
                                <td class="py-4">{{ $details['quantity'] }}</td>
                                <td class="py-4">${{ $details['price'] * $details['quantity'] }}</td>
                                <td class="py-4">
                                    <form action="{{ route('zensara.cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">Total:</span>
                    <span class="font-bold text-lg">${{ $total }}</span>
                </div>
            </div>

            <!-- Formulario para Datos de Envío -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-2xl font-bold mb-4">Datos de Envío</h2>
                <form action="{{ route('zensara.quotation.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="products" value="{{ json_encode($cartItems) }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="hidden" name="total" id="" value="{{ $total }}" readonly="true">
                        <input type="text" name="name" value="Ricardo Lugo " placeholder="Nombre" class="p-2 border rounded"
                            required>
                        <input type="text" name="company" value="" placeholder="Empresa (opcional)"
                            class="p-2 border rounded">
                        <input type="email" name="email" value="richie.lugo.recillas.1990@gmail.com" placeholder="Correo Electrónico"
                            class="p-2 border rounded">
                        <input type="text" name="phone" value="7224601404" placeholder="Teléfono" class="p-2 border rounded"
                            required>
                        <input type="text" name="street" value="avenida revolución" placeholder="Calle"
                            class="p-2 border rounded" required>
                        <input type="text" name="number" value="1500" placeholder="Número" class="p-2 border rounded"
                            required>
                        <input type="text" name="district" value="san angel" placeholder="Colonia"
                            class="p-2 border rounded">
                        <input type="text" name="city" value="ciudad de méxico" placeholder="Ciudad"
                            class="p-2 border rounded" required>
                        <input type="text" name="state" value="cmx" placeholder="Estado" class="p-2 border rounded"
                            required>
                        <input type="text" name="postalCode" value="50000" placeholder="Código Postal"
                            class="p-2 border rounded" required>
                        <input type="text" name="reference" value="" placeholder="Referencia (opcional)"
                            class="p-2 border rounded">
                    </div>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Generar
                        Envío</button>
                </form>
            </div>
            <div class="mt-6">
                <a href="{{ route('zensara.index') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Continuar Comprando</a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <p>Tu carrito está vacío.</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('zensara.index') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Ir a Comprar</a>
            </div>
        @endif
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form[action="{{ route("zensara.quotation.create") }}"]');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.textContent = 'Procesando...'; // Cambia el texto del botón opcionalmente
        });
    });
</script>

</html>