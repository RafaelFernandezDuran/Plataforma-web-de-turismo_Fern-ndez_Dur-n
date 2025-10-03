<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class TourImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Imágenes de ejemplo específicas para Chanchamayo y turismo peruano
        $sampleImages = [
            'aventura' => [
                'https://images.unsplash.com/photo-1464822759844-d150115c0ee6?w=800&h=600&fit=crop&q=80', // Montañas peruanas
                'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800&h=600&fit=crop&q=80', // Rafting
                'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&h=600&fit=crop&q=80', // Trekking
                'https://images.unsplash.com/photo-1506012787146-f92b2d7d6d96?w=800&h=600&fit=crop&q=80', // Aventura montaña
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&q=80', // Paisaje montañoso
                'https://images.unsplash.com/photo-1575598171129-a8ca1bde5e5a?w=800&h=600&fit=crop&q=80', // Caminata selva
            ],
            'ecoturismo' => [
                'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=600&fit=crop&q=80', // Bosque tropical
                'https://images.unsplash.com/photo-1518837695005-2083093ee35b?w=800&h=600&fit=crop&q=80', // Naturaleza exuberante
                'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800&h=600&fit=crop&q=80', // Selva amazónica
                'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=800&h=600&fit=crop&q=80', // Cascada selva
                'https://images.unsplash.com/photo-1574260850081-65deefeeb0fb?w=800&h=600&fit=crop&q=80', // Flora tropical
                'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?w=800&h=600&fit=crop&q=80', // Río selva
            ],
            'gastronomico' => [
                'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop&q=80', // Granos de café
                'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&q=80', // Comida gourmet
                'https://images.unsplash.com/photo-1589737008291-21fece2f9cb2?w=800&h=600&fit=crop&q=80', // Café peruano
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&h=600&fit=crop&q=80', // Cocina tradicional
                'https://images.unsplash.com/photo-1563379091339-03246963d4d9?w=800&h=600&fit=crop&q=80', // Experiencia culinaria
                'https://images.unsplash.com/photo-1544148103-0773bf10d330?w=800&h=600&fit=crop&q=80', // Productos locales
            ],
            'cultural' => [
                'https://images.unsplash.com/photo-1539650116574-75c0c6d73c0e?w=800&h=600&fit=crop&q=80', // Cultura peruana
                'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&h=600&fit=crop&q=80', // Arquitectura colonial
                'https://images.unsplash.com/photo-1504650708917-2fb6eb827e91?w=800&h=600&fit=crop&q=80', // Arte tradicional
                'https://images.unsplash.com/photo-1503891450247-ee5f8ec46dd4?w=800&h=600&fit=crop&q=80', // Iglesia colonial
                'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800&h=600&fit=crop&q=80', // Textiles andinos
                'https://images.unsplash.com/photo-1562108721-6e4cfe088c77?w=800&h=600&fit=crop&q=80', // Música folclórica
            ],
            'relax' => [
                'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&q=80', // Spa natural
                'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&h=600&fit=crop&q=80', // Aguas termales
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&q=80', // Paisaje relajante
                'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=600&fit=crop&q=80', // Yoga en naturaleza
            ]
        ];

        $tours = Tour::with('category')->get();

        foreach ($tours as $tour) {
            if (!$tour->main_image) {
                $categorySlug = strtolower($tour->category->slug ?? 'aventura');
                
                // Buscar la categoría más cercana
                $categoryKey = 'aventura'; // default
                foreach ($sampleImages as $key => $images) {
                    if (str_contains($categorySlug, $key) || $categorySlug === $key) {
                        $categoryKey = $key;
                        break;
                    }
                }

                // Asignar una imagen aleatoria de la categoría
                $randomImage = $sampleImages[$categoryKey][array_rand($sampleImages[$categoryKey])];
                
                $tour->update([
                    'main_image' => $randomImage
                ]);
            }
        }

        $this->command->info('Imágenes predefinidas asignadas a los tours exitosamente.');
    }
}