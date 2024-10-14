<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => fake()->sentence(3),
            'image_url' => $this->getUniquePicsumUrl(),
            'body' => fake()->paragraph(20),
        ];
    }

    public function forUser($userId): static
    {
        return $this->state([
            'user_id' => $userId,
        ]);
    }

    private function getUniquePicsumUrl(): string
    {
        $width = 640;
        $height = 480;
        $randomId = $this->faker->numberBetween(1, 1000);

        return "https://picsum.photos/seed/{$randomId}/{$width}/{$height}";
    }
}
