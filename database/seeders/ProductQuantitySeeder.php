<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductQuantity;

class ProductQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductQuantity::factory()->count(50)->create(); // Adjust the count as needed
    }
}
