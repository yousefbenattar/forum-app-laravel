<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str as Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph(),
            'image' => 'https://picsum.photos/640/480?random=' . fake()->numberBetween(1, 1000),
            'user_id' => fake()->numberBetween(1, 10),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
