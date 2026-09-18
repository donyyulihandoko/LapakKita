<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' =>  'https://picsum.photos/seed/' . Str::random(10) . '/600/600',
            'description' => fake()->paragraph(3),
            'status' => 'active'
        ];
    }
}
