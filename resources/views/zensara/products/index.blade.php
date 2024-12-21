<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Lista de Productos</h1>
            <a href="{{ route('zensara.cart') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Ver Carrito</a>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold">${{ number_format($product->price, 2) }}</span>
                        @if(isset($product->stock))
                            <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                        @endif
                    </div>
                    <form action="{{ route('zensara.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Añadir al Carrito</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
