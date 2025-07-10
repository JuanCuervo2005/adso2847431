<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $kinds = [
            'Dog' => 'dog.jpg',
            'Cat' => 'cat.jpg',
            'Fish' => 'fish.jpg',
            'Mouse' => 'mouse.jpg',
            'Bird' => 'bird.jpg',
        ];
        $kind = fake()->randomElement(array_keys($kinds));
        $image = $kinds[$kind] ?? 'no-photo.jpg';
        return [
            'name'        => fake()->domainWord(),
            'kind'        => $kind,
            'image'       => $image,
            'weight'      => fake()->numberBetween(1, 80),
            'age'         => fake()->numberBetween(1, 20),
            'breed'       => fake()->colorName(),
            'location'    => fake()->city(),
            'description' => fake()->sentence(10),
            'created_at'  => now()
        ];
    }
}
