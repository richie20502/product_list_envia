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
            ['name' => 'PULSERA ORISHA OBATALA BOTON CAMINO DE MUERTO DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTON CAMINO DE MUERTO DE 1 HILO EN ZENSARA', 'price' => 39.99, 'stock' => 10, 'weight' => 0.5, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA SANTO 6 HILOS EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA SANTO 6 HILOS EN ZENSARA', 'price' => 199.99, 'stock' => 5, 'weight' => 0.5, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA TRENZADA SANTO DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA TRENZADA SANTO DE 1 HILO EN ZENSARA', 'price' => 59.99, 'stock' => 20, 'weight' => 1, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA BOTÓN DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTÓN DE 1 HILO EN ZENSARA', 'price' => 19.99, 'stock' => 15, 'weight' => 0.2, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA AJUSTABLE DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA AJUSTABLE DE 1 HILO EN ZENSARA', 'price' => 39.99, 'stock' => 8, 'weight' => 0.8, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA BOLA BLANCA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOLA BLANCA DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 12, 'weight' => 0.35, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA BOLA PLATEADA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOLA PLATEADA DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 9, 'weight' => 0.6, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OBATALA BOTÓN GALA DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OBATALA BOTÓN GALA DE 1 HILO EN ZENSARA', 'price' => 29.99, 'stock' => 20, 'weight' => 0.25, 'weight_unit' => 'KG'],
            ['name' => 'MAZO ORISHA OBATALA CAMINO DE MUERTO CHAQUIRÓN PERSONAL EN ZENSARA', 'description' => 'MAZO ORISHA OBATALA CAMINO DE MUERTO CHAQUIRÓN PERSONAL EN ZENSARA', 'price' => 449.99, 'stock' => 3, 'weight' => 2, 'weight_unit' => 'KG'], // Ajustado al máximo permitido
            ['name' => 'LLAVERO ORISHA OBATALA SANTO EN ZENSARA', 'description' => 'LLAVERO ORISHA OBATALA SANTO EN ZENSARA', 'price' => 99.99, 'stock' => 15, 'weight' => 0.15, 'weight_unit' => 'KG'],
            ['name' => 'AKETEQUILLA BLANCO PARA MUJER Y HOMBRE EN ZENSARA', 'description' => 'AKETEQUILLA BLANCO PARA MUJER Y HOMBRE EN ZENSARA', 'price' => 99.99, 'stock' => 5, 'weight' => 1, 'weight_unit' => 'KG'],
            ['name' => 'AKETE ORISHA OBATALA DE GALA EN ZENSARA', 'description' => 'AKETE ORISHA OBATALA DE GALA EN ZENSARA', 'price' => 249.99, 'stock' => 7, 'weight' => 1.5, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OSHUN BOLA AMBAR DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN BOLA AMBAR DE 1 HILO EN ZENSARA', 'price' => 99.99, 'stock' => 15, 'weight' => 0.3, 'weight_unit' => 'KG'],
            ['name' => 'PULSERA ORISHA OSHUN BOTON AMBAR DE 1 HILO EN ZENSARA', 'description' => 'PULSERA ORISHA OSHUN BOTON AMBAR DE 1 HILO EN ZENSARA', 'price' => 19.99, 'stock' => 20, 'weight' => 0.2, 'weight_unit' => 'KG'], // Convertido de gramos a KG
            ['name' => 'PULSERA EXCLUSIVA OSHUN CAMINO DE MUERTO EN ZENSARA', 'description' => 'PULSERA EXCLUSIVA OSHUN CAMINO DE MUERTO EN ZENSARA', 'price' => 29.99, 'stock' => 10, 'weight' => 0.25, 'weight_unit' => 'KG'], // Convertido de gramos a KG
            ['name' => 'MACUTO ORISHA OSHUN EN ZENSARA', 'description' => 'MACUTO ORISHA OSHUN EN ZENSARA', 'price' => 40.99, 'stock' => 5, 'weight' => 1, 'weight_unit' => 'KG'],
        ];
        

        foreach ($products as $product) {
            ProductsZenzara::create($product);
        }
    }
}
