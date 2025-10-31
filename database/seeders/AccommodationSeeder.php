<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\Company;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::take(3)->get();

        $sampleData = [
            [
                'name' => 'Selva Verde Lodge',
                'slug' => 'selva-verde-lodge',
                'type' => 'eco-lodge',
                'description' => 'Alojamiento inmerso en la selva con habitaciones tipo bungalow, ideales para desconectarse y vivir experiencias amazónicas auténticas.',
                'address' => 'Carretera Marginal 12 km, La Merced',
                'city' => 'La Merced',
                'region' => 'Junín',
                'price_per_night' => 180.00,
                'amenities' => ['Wi-Fi', 'Desayuno incluido', 'Tours guiados', 'Piscina natural'],
                'main_image' => 'images/getlstd-property-photo.jpg',
                'gallery' => [
                    'images/catarata_tirol.jpg',
                    'images/kimiri.jpg',
                    'images/cafe.jpg',
                ],
                'rating' => 4.7,
                'total_reviews' => 58,
            ],
            [
                'name' => 'Mirador Andino Boutique Hotel',
                'slug' => 'mirador-andino-boutique-hotel',
                'type' => 'hotel',
                'description' => 'Hotel boutique con vistas a la selva alta, habitaciones premium y gastronomía local, ideal para parejas y viajes familiares.',
                'address' => 'Jr. Amazonas 233, San Ramón',
                'city' => 'San Ramón',
                'region' => 'Junín',
                'price_per_night' => 240.00,
                'amenities' => ['Wi-Fi', 'Restaurante', 'Spa', 'Transporte al aeropuerto'],
                'main_image' => 'images/piramide-chanchamayo.jpg',
                'gallery' => [
                    'images/hotel.jpg',
                    'images/vista-a-la-piscina.jpg',
                    'images/getlstd-property-photo.jpg',
                ],
                'rating' => 4.9,
                'total_reviews' => 92,
            ],
            [
                'name' => 'Refugio Catarata Suites',
                'slug' => 'refugio-catarata-suites',
                'type' => 'lodge',
                'description' => 'Suites amplias rodeadas de cataratas y jardines, con experiencias de bienestar y conexión con la naturaleza.',
                'address' => 'Camino a Kimiri, km 7',
                'city' => 'Perené',
                'region' => 'Junín',
                'price_per_night' => 210.00,
                'amenities' => ['Wi-Fi', 'Jacuzzi', 'Fogatas nocturnas', 'Clases de yoga'],
                'main_image' => 'images/vista-a-la-piscina.jpg',
                'gallery' => [
                    'images/catarata_tirol.jpg',
                    'images/kimiri.jpg',
                    'images/hotel.jpg',
                ],
                'rating' => 4.8,
                'total_reviews' => 76,
            ],
        ];

        $companyCount = max($companies->count(), 1);
        $fallbackCompany = $companies->first();

        foreach ($sampleData as $index => $data) {
            $company = $companies[$index % $companyCount] ?? $fallbackCompany;
            $data['company_id'] = $company?->id;

            Accommodation::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
