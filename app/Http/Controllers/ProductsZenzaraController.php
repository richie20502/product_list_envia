<?php

namespace App\Http\Controllers;

use App\Models\ProductsZenzara as Zensara;
use Illuminate\Http\Request;

class ProductsZenzaraController extends Controller
{
    public function index()
    {
        $products = Zensara::all();
        return view('zensara.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        Zensara::create($request->all());
        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }


    public function add(Request $request, $id)
    {
        $product = Zensara::findOrFail($id);
        $cart = session()->get('cart_zensara', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description
            ];
        }

        session()->put('cart_zensara', $cart);
        return redirect()->back()->with('success', 'Producto añadido al carrito exitosamente!');
    }


    public function cart()
    {
        $cartItems = session()->get('cart_zensara', []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('zensara.cart.index', compact('cartItems', 'total'));
    }
}
