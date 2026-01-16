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
        $indianProducts = [
            [
                'name' => 'Men\'s Cotton Kurta (White)',
                'sku' => 'KURTA-WHT-001',
                'price' => 1299.00,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Kanjivaram Silk Saree (Red)',
                'sku' => 'SAREE-KNJ-RED',
                'price' => 12500.00,
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Tata Tea Gold (500g)',
                'sku' => 'GROC-TEA-TATA',
                'price' => 450.00,
                'stock' => 200,
                'is_active' => true,
            ],
            [
                'name' => 'India Gate Basmati Rice (5kg)',
                'sku' => 'GROC-RICE-IG5',
                'price' => 899.00,
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Haldiram\'s Bhujia Sev (400g)',
                'sku' => 'SNACK-NV-HAL',
                'price' => 110.00,
                'stock' => 150,
                'is_active' => true,
            ],
            [
                'name' => 'Asian Paints Royal Emulsion (4L)',
                'sku' => 'HOME-PNT-ROY',
                'price' => 3200.00,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Prestige Pressure Cooker (3L)',
                'sku' => 'KIT-COOK-PRE3',
                'price' => 1850.00,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Boat Airdopes 141',
                'sku' => 'ELEC-AUD-BOAT',
                'price' => 1499.00,
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'name' => 'OnePlus Nord CE 3 Lite',
                'sku' => 'MOB-OP-NORD3',
                'price' => 19999.00,
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Wildcraft Work Pack (Black)',
                'sku' => 'BAG-WC-BLK01',
                'price' => 1599.00,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Dabur Chyawanprash (1kg)',
                'sku' => 'HEALTH-DAB-CP',
                'price' => 395.00,
                'stock' => 120,
                'is_active' => true,
            ],
            [
                'name' => 'Titan Karishma Analog Watch',
                'sku' => 'WAT-TIT-KAR',
                'price' => 2495.00,
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'name' => 'Faber Castell Colour Pencils',
                'sku' => 'STAT-FC-COL',
                'price' => 250.00,
                'stock' => 300,
                'is_active' => true,
            ],
            [
                'name' => 'Amul Butter (500g)',
                'sku' => 'DAIRY-AMUL-BUT',
                'price' => 275.00,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Yoga Mat - Decathlon',
                'sku' => 'SPORT-YOGA-DEC',
                'price' => 699.00,
                'stock' => 75,
                'is_active' => true,
            ],
        ];

        foreach ($indianProducts as $product) {
            Product::create($product);
        }
    }
}
