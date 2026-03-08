<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Location;
use App\Models\Product;
use App\Models\Movement;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electrónica', 'description' => 'Productos electrónicos'],
            ['name' => 'Ropa', 'description' => 'Ropa y accesorios'],
            ['name' => 'Alimentos', 'description' => 'Productos alimenticios'],
            ['name' => 'Herramientas', 'description' => 'Herramientas y materiales'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $locations = [
            ['name' => 'Bodega A', 'zone' => 'A', 'shelf' => '1'],
            ['name' => 'Bodega A', 'zone' => 'A', 'shelf' => '2'],
            ['name' => 'Bodega B', 'zone' => 'B', 'shelf' => '1'],
            ['name' => 'Bodega B', 'zone' => 'B', 'shelf' => '2'],
        ];

        foreach ($locations as $loc) {
            Location::create($loc);
        }

        $products = [
            ['sku' => 'ELEC-001', 'name' => 'Laptop HP', 'category_id' => 1, 'location_id' => 1, 'stock' => 25, 'min_stock' => 5],
            ['sku' => 'ELEC-002', 'name' => 'Mouse Inalámbrico', 'category_id' => 1, 'location_id' => 1, 'stock' => 50, 'min_stock' => 10],
            ['sku' => 'ROPA-001', 'name' => 'Camisa Manga Larga', 'category_id' => 2, 'location_id' => 3, 'stock' => 100, 'min_stock' => 20],
            ['sku' => 'ROPA-002', 'name' => 'Pantalón Jeans', 'category_id' => 2, 'location_id' => 3, 'stock' => 8, 'min_stock' => 15],
            ['sku' => 'ALIM-001', 'name' => 'Arroz 1kg', 'category_id' => 3, 'location_id' => 4, 'stock' => 200, 'min_stock' => 50],
            ['sku' => 'ALIM-002', 'name' => 'Fideos 500g', 'category_id' => 3, 'location_id' => 4, 'stock' => 150, 'min_stock' => 30],
            ['sku' => 'HERR-001', 'name' => 'Destornillador', 'category_id' => 4, 'location_id' => 2, 'stock' => 5, 'min_stock' => 10],
            ['sku' => 'HERR-002', 'name' => 'Martillo', 'category_id' => 4, 'location_id' => 2, 'stock' => 30, 'min_stock' => 5],
        ];

        foreach ($products as $prod) {
            $product = Product::create($prod);
            
            Movement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'quantity' => $prod['stock'],
                'notes' => 'Stock inicial',
            ]);
        }
    }
}
