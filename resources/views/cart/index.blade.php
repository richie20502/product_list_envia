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
        <h1 class="text-3xl font-bold mb-6">Carrito de Compras</h1>
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
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
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
            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Continuar Comprando</a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <p>Tu carrito está vacío.</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Ir a Comprar</a>
            </div>
        @endif
    </div>
</body>
</html>