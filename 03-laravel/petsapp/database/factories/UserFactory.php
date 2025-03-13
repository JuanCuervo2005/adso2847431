<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);

        if ($gender === 'Male') {
            $fullname = fake()->firstNameMale() . ' ' . fake()->lastName();
            $profileImageUrl = 'https://avatar.iran.liara.run/public/boy';
        } else {
            $fullname = fake()->firstNameFemale() . ' ' . fake()->lastName();
            $profileImageUrl = 'https://avatar.iran.liara.run/public/girl';
        }

        $document = fake()->numerify('75#####');

        $response = Http::get($profileImageUrl);
        
        if ($response->successful()) {

            $imageContents = $response->body();

            $extension = pathinfo($profileImageUrl, PATHINFO_EXTENSION);

            if (!$extension) {
                $extension = 'png';
            }

            $imageName = $document . '.' . $extension;

            $imagePath = storage_path('app/public/profile_images/' . $imageName);

            if (!File::exists(storage_path('app/public/profile_images'))) {
                File::makeDirectory(storage_path('app/public/profile_images'), 0775, true);
            }

            File::put($imagePath, $imageContents);

            $profileImagePath = 'storage/profile_images/' . $imageName;
        } else {

            $profileImagePath = 'storage/profile_images/default.png';
        }

        return [
            'document' => $document,
            'fullname' => $fullname,
            'gender' => $gender,
            'birthdate' => fake()->dateTimeBetween('1974-01-01', '2004-12-31'),
            'photo' => $profileImagePath, // Ruta de la imagen en la base de datos
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('12345'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
