<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Accommodation> */
class AccommodationFactory extends Factory
{
    protected $model = Accommodation::class;

    public function definition(): array
    {
        $name = fake()->unique()->company();

        return [
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 999),
            'type' => fake()->randomElement(['hotel', 'lodge', 'eco-lodge', 'hostal']),
            'description' => fake()->paragraphs(3, true),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'region' => 'Junín',
            'price_per_night' => fake()->randomFloat(2, 60, 300),
            'amenities' => fake()->randomElements([
                'Wi-Fi', 'Desayuno incluido', 'Piscina', 'Transporte al aeropuerto',
                'Pet friendly', 'Tours guiados', 'Restaurante', 'Spa'
            ], 4),
            'main_image' => 'images/accommodations/sample-' . fake()->numberBetween(1, 5) . '.jpg',
            'gallery' => [],
            'rating' => fake()->randomFloat(1, 3.5, 5.0),
            'total_reviews' => fake()->numberBetween(5, 250),
            'status' => 'active',
        ];
    }
}
