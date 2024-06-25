<?php

namespace Database\Factories;

use App\Models\ProductAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttachmentFactory extends Factory
{
    protected $model = ProductAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uploaded_user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'attachmentable_id' => function () {
                return \App\Models\Product::factory()->create()->id;
            },
            'attachmentable_type' => 'App\Models\Product', // Adjust this according to your related model class
            'url' => $this->faker->url,
            'state' => $this->faker->randomElement(['active', 'inactive', 'draft']),
            'label' => $this->faker->word,
            'file' => $this->faker->word,
            'content_type' => $this->faker->mimeType,
            'user' => $this->faker->userName,
        ];
        
    }
}
