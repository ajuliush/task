<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'sku' => strtoupper(Str::random(10)),
            'symbology' => $this->faker->word,
            'brand_id' => \App\Models\Brand::factory(),
            'category_id' => \App\Models\Category::factory(),
            'unit_id' => \App\Models\Unit::factory(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'qty' => $this->faker->numberBetween(1, 100),
            'alert_qty' => $this->faker->numberBetween(1, 10),
            'tax_method' => $this->faker->randomElement(['inclusive', 'exclusive']),
            'tax_id' => \App\Models\Tax::factory(),
            'has_stock' => $this->faker->boolean,
            'has_expired_date' => $this->faker->boolean,
            'expired_date' => $this->faker->date,
            'details' => $this->faker->paragraph,
            'is_active' => $this->faker->boolean,
        ];
        
    }
}
