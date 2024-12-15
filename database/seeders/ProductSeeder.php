<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone X1',
                'description' => 'Smartphone de alta calidad para electrónica',
                'price' => 599.99,
                'stock' => 100
            ],
            [
                'name' => 'Laptop Pro 15',
                'description' => 'Laptop de alta calidad para electrónica',
                'price' => 1299.99,
                'stock' => 50
            ],
            [
                'name' => 'Auriculares NoiseCancel',
                'description' => 'Auriculares de alta calidad para electrónica',
                'price' => 199.99,
                'stock' => 200
            ],
            [
                'name' => 'Smartwatch FitPro',
                'description' => 'Smartwatch de alta calidad para electrónica',
                'price' => 249.99,
                'stock' => 150
            ],
            [
                'name' => 'Tablet UltraSlim',
                'description' => 'Tablet de alta calidad para electrónica',
                'price' => 399.99,
                'stock' => 75
            ],
            [
                'name' => 'Aspiradora RoboClean',
                'description' => 'Aspiradora robot de alta calidad para hogar',
                'price' => 299.99,
                'stock' => 80
            ],
            [
                'name' => 'Cafetera BrewMaster',
                'description' => 'Cafetera de alta calidad para hogar',
                'price' => 129.99,
                'stock' => 120
            ],
            [
                'name' => 'Licuadora PowerBlend',
                'description' => 'Licuadora de alta calidad para hogar',
                'price' => 79.99,
                'stock' => 100
            ],
            [
                'name' => 'Microondas QuickHeat',
                'description' => 'Microondas de alta calidad para hogar',
                'price' => 149.99,
                'stock' => 60
            ],
            [
                'name' => 'Freidora de aire HealthyCook',
                'description' => 'Freidora de aire de alta calidad para hogar',
                'price' => 99.99,
                'stock' => 90
            ],
            [
                'name' => 'Zapatillas RunFast',
                'description' => 'Zapatillas de alta calidad para moda',
                'price' => 89.99,
                'stock' => 200
            ],
            [
                'name' => 'Jeans ClassicFit',
                'description' => 'Jeans de alta calidad para moda',
                'price' => 59.99,
                'stock' => 150
            ],
            [
                'name' => 'Camiseta ComfortSoft',
                'description' => 'Camiseta de alta calidad para moda',
                'price' => 29.99,
                'stock' => 300
            ],
            [
                'name' => 'Chaqueta AllWeather',
                'description' => 'Chaqueta de alta calidad para moda',
                'price' => 129.99,
                'stock' => 100
            ],
            [
                'name' => 'Vestido ElegantNight',
                'description' => 'Vestido de alta calidad para moda',
                'price' => 79.99,
                'stock' => 80
            ],
            [
                'name' => 'Pelota de fútbol ProKick',
                'description' => 'Pelota de fútbol de alta calidad para deportes',
                'price' => 39.99,
                'stock' => 150
            ],
            [
                'name' => 'Raqueta de tenis PowerServe',
                'description' => 'Raqueta de tenis de alta calidad para deportes',
                'price' => 159.99,
                'stock' => 70
            ],
            [
                'name' => 'Mancuernas FitLife',
                'description' => 'Mancuernas de alta calidad para deportes',
                'price' => 49.99,
                'stock' => 100
            ],
            [
                'name' => 'Esterilla de yoga ZenFlex',
                'description' => 'Esterilla de yoga de alta calidad para deportes',
                'price' => 29.99,
                'stock' => 200
            ],
            [
                'name' => 'Bicicleta estática CycleMax',
                'description' => 'Bicicleta estática de alta calidad para deportes',
                'price' => 399.99,
                'stock' => 40
            ],
            [
                'name' => 'Cortacésped EcoMow',
                'description' => 'Cortacésped de alta calidad para jardín',
                'price' => 249.99,
                'stock' => 50
            ],
            [
                'name' => 'Regadera AutoSpray',
                'description' => 'Regadera de alta calidad para jardín',
                'price' => 19.99,
                'stock' => 150
            ],
            [
                'name' => 'Maceta DecorGrow',
                'description' => 'Maceta de alta calidad para jardín',
                'price' => 14.99,
                'stock' => 200
            ],
            [
                'name' => 'Semillas OrganiGrow',
                'description' => 'Semillas de alta calidad para jardín',
                'price' => 9.99,
                'stock' => 300
            ],
            [
                'name' => 'Podadora PrecisionCut',
                'description' => 'Podadora de alta calidad para jardín',
                'price' => 79.99,
                'stock' => 80
            ],
            // ... (continúa con más productos hasta llegar a 100)
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }

    
}
