<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttachment;

class ProductAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttachment::factory()->count(50)->create(); // Adjust the count as needed
    }
}
