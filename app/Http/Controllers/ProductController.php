<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Services\AuthService;

class ProductController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        $token = $this->authService->getToken();
        dd($token);
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
