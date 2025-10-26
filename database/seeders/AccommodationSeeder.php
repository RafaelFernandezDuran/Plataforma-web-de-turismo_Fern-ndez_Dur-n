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
                'main_image' => 'https://images.unsplash.com/photo-1470246973918-29a93221c455?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80',
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
                'main_image' => 'https://images.unsplash.com/photo-1551887373-6b25f87b09ae?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1496417263034-38ec4f0b665a?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=1200&q=80',
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
                'main_image' => 'https://images.unsplash.com/photo-1528909514045-2fa4ac7a08ba?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1512914890250-353c87e1c36f?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1200&q=80',
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
