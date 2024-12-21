<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsZenzara;

class ProductsZenzaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'PULSERA ORISHA OBATALA BOTON CAMINO DE MUERTO DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTON CAMINO DE MUERTO DE 1 HILO EN ZENSARA', 'price' => 39.99, 'stock' => 10],
            ['name' => 'PULSERA ORISHA OBATALA SANTO 6 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA SANTO 6 HILOS EN ZENSARA', 'price' => 199.99, 'stock' => 5],
            ['name' => 'PULSERA ORISHA OBATALA TRENZADA SANTO DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA TRENZADA SANTO DE 1 HILO EN ZENSARA', 'price' => 59.99, 'stock' => 20],
            ['name' => 'PULSERA ORISHA OBATALA BOTÓN DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTÓN DE 1 HILO EN ZENSARA', 'price' => 19.99, 'stock' => 15],
            ['name' => 'PULSERA ORISHA OBATALA AJUSTABLE DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA AJUSTABLE DE 1 HILO EN ZENSARA', 'price' => 39.99, 'stock' => 8],
            ['name' => 'PULSERA ORISHA OBATALA BOLA BLANCA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOLA BLANCA DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 12],
            ['name' => 'PULSERA ORISHA OBATALA BOLA PLATEADA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOLA PLATEADA DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 9],
            ['name' => 'PULSERA ORISHA OBATALA BOTÓN GALA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTÓN GALA DE 1 HILO EN ZENSARA', 'price' => 29.99, 'stock' => 20],
            ['name' => 'MAZO ORISHA OBATALA CAMINO DE MUERTO CHAQUIRÓN PERSONAL EN ZENSARA', 'description' => 'MAZO ORISHA OBATALA CAMINO DE MUERTO CHAQUIRÓN PERSONAL EN ZENSARA', 'price' => 449.99, 'stock' => 3],
            ['name' => 'LLAVERO ORISHA OBATALA SANTO EN ZENSARA', 'description' => 'LLAVERO ORISHA OBATALA SANTO EN ZENSARA', 'price' => 99.99, 'stock' => 15],
            ['name' => 'AKETEQUILLA BLANCO PARA MUJER Y HOMBRE EN ZENSARA', 'description' => 'AKETEQUILLA BLANCO PARA MUJER Y HOMBRE EN ZENSARA', 'price' => 99.99, 'stock' => 5],
            ['name' => 'AKETE ORISHA OBATALA DE GALA EN ZENSARA', 'description' => 'AKETE ORISHA OBATALA DE GALA EN ZENSARA', 'price' => 249.99, 'stock' => 7],
            ['name' => 'MUÑECO OBATALA DE GALA GATEADOR', 'description' => 'MUÑECO OBATALA DE GALA GATEADOR', 'price' => 799.99, 'stock' => 2],
            ['name' => 'PULSERA ORISHA YEMAYA SANTO DE 3 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA SANTO DE 3 HILOS EN ZENSARA', 'price' => 99.99, 'stock' => 10],
            ['name' => 'PULSERA ORISHA YEMAYA CAMINO DE MUERTO 3 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA CAMINO DE MUERTO 3 HILOS EN ZENSARA', 'price' => 99.99, 'stock' => 8],
            ['name' => 'PULSERA ORISHA YEMAYA BROCHE DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA BROCHE DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 12],
            ['name' => 'PULSERA ORISHA YEMAYA BOTON AZUL DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA BOTON AZUL DE 1 HILO EN ZENSARA', 'price' => 19.99, 'stock' => 20],
            ['name' => 'PULSERA ORISHA YEMAYA AJUSTABLE GRANDE DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA AJUSTABLE GRANDE DE 1 HILO EN ZENSARA', 'price' => 39.99, 'stock' => 10],
            ['name' => 'PULSERA ORISHA YEMAYA AJUSTABLE CHAQUIRA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA YEMAYA AJUSTABLE CHAQUIRA DE 1 HILO EN ZENSARA', 'price' => 29.99, 'stock' => 25],
            ['name' => 'AKETE ORISHA YEMAYA DE GALA EN ZENSARA', 'description' => 'AKETE ORISHA YEMAYA DE GALA EN ZENSARA', 'price' => 249.99, 'stock' => 5],
            ['name' => 'FIGURA ORISHA YEMAYA SIRENA BRONCE ARIGINAL EN ZENSARA', 'description' => 'FIGURA ORISHA YEMAYA SIRENA BRONCE ARIGINAL EN ZENSARA', 'price' => 2799.99, 'stock' => 1],
            ['name' => 'MUÑECO OSHUN DE SATIN GATEADOR', 'description' => 'MUÑECO OSHUN DE SATIN GATEADOR', 'price' => 699.99, 'stock' => 3],
            ['name' => 'PULSERA ORISHA OSHUN SANTO DE 18 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN SANTO DE 18 HILOS EN ZENSARA', 'price' => 399.99, 'stock' => 4],
            ['name' => 'PULSERA ORISHA OSHUN CAMINO DE MUERTO DE 18 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN CAMINO DE MUERTO DE 18 HILOS EN ZENSARA', 'price' => 399.99, 'stock' => 3],
            ['name' => 'PULSERA ORISHA OSHUN BOLA AMBAR DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN BOLA AMBAR DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 15],
            ['name' => 'PULSERA ORISHA OSHUN BOTON AMBAR DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN BOTON AMBAR DE 1 HILO EN ZENSARA', 'price' => 19.99, 'stock' => 20],
            ['name' => 'PULSERA EXCLUSIVA OSHUN CAMINO DE MUERTO EN ZENSARA', 'description' => 'PULSERA EXCLUSIVA OSHUN CAMINO DE MUERTO EN ZENSARA', 'price' => 29.99, 'stock' => 10],
            ['name' => 'MACUTO ORISHA OSHUN EN ZENSARA', 'description' => 'MACUTO ORISHA OSHUN EN ZENSARA', 'price' => 40.99, 'stock' => 5],
        ];

        foreach ($products as $product) {
            ProductsZenzara::create($product);
        }
    }
}
