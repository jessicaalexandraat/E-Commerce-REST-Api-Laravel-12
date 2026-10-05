<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Blazer Elegante Estructurado',
                'description' => 'Blazer confeccionado en tela de alta calidad, ideal para eventos formales y estilo profesional.',
                'price' => 89.99,
                'stock' => 15,
            ],
            [
                'name' => 'Vestido Midi Atemporal',
                'description' => 'Vestido corte midi con diseño atemporal y textura suave para cualquier ocasión.',
                'price' => 65.50,
                'stock' => 25,
            ],
            [
                'name' => 'Camisa de Seda Minimalista',
                'description' => 'Camisa holgada con acabados premium y caída elegante.',
                'price' => 45.00,
                'stock' => 30,
            ],
            [
                'name' => 'Pantalón de Vestir Talle Alto',
                'description' => 'Pantalón con corte estilizado, ajuste cómodo y tejido resistente.',
                'price' => 59.99,
                'stock' => 20,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
