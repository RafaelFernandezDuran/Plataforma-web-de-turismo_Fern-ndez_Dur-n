<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Aventura y Deportes Extremos',
                'slug' => 'aventura-deportes-extremos',
                'description' => 'Tours llenos de adrenalina: tirolesas, rappel, rafting y más',
                'icon' => 'adventure',
                'color' => '#EF4444',
                'sort_order' => 1
            ],
            [
                'name' => 'Turismo Gastronómico',
                'slug' => 'turismo-gastronomico',
                'description' => 'Descubre los sabores únicos de Chanchamayo',
                'icon' => 'restaurant',
                'color' => '#F59E0B',
                'sort_order' => 2
            ],
            [
                'name' => 'Ecoturismo',
                'slug' => 'ecoturismo',
                'description' => 'Conecta con la naturaleza en su estado más puro',
                'icon' => 'nature',
                'color' => '#10B981',
                'sort_order' => 3
            ],
            [
                'name' => 'Turismo Cultural',
                'slug' => 'turismo-cultural',
                'description' => 'Conoce las tradiciones y cultura local',
                'icon' => 'culture',
                'color' => '#8B5CF6',
                'sort_order' => 4
            ],
            [
                'name' => 'Caminatas y Trekking',
                'slug' => 'caminatas-trekking',
                'description' => 'Senderos y rutas para todos los niveles',
                'icon' => 'hiking',
                'color' => '#06B6D4',
                'sort_order' => 5
            ],
            [
                'name' => 'Relajación y Bienestar',
                'slug' => 'relajacion-bienestar',
                'description' => 'Tours para desconectarte y renovar energías',
                'icon' => 'spa',
                'color' => '#EC4899',
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\TourCategory::create($category);
        }
    }
}
