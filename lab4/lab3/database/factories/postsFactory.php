<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class postsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = 'default.png';
        return [
            'title' => fake()->sentence(),
            'body' => substr(fake()->paragraph(), 0, 100),//to limit the length of paragraph 
            'image' => $image,
            'author' => rand(1,10),
        ];
    }
}
