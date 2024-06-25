<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'code' => strtoupper(Str::random(10)),
            'for' => $this->faker->word,
            'base_unit' => $this->faker->boolean(50),
            'operator' => $this->faker->randomElement(['+', '-', '*', '/']),
            'operation_value' => $this->faker->randomFloat(2, 0, 100),
            'is_active' => $this->faker->boolean,
        ];
    }
}
