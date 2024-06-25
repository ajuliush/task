<?php

namespace Database\Factories;

use App\Models\ProductQuantity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductQuantityFactory extends Factory
{
    protected $model = ProductQuantity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function () {
                return \App\Models\Product::factory()->create()->id;
            },
            'warehouse_id' => function () {
                return \App\Models\Warehouse::factory()->create()->id;
            },
            'qty' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
