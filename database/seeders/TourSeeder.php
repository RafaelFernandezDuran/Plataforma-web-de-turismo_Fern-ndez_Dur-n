<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\Company;
use App\Models\TourCategory;
use App\Models\User;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear una empresa de ejemplo si no existe
        $user = User::firstOrCreate(
            ['email' => 'empresa@chanchamayo.com'],
            [
                'name' => 'Chanchamayo Adventures',
                'password' => bcrypt('password'),
                'user_type' => 'company_admin',
            ]
        );

        if (is_null($user->email_verified_at)) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        $company = Company::firstOrCreate(
            ['user_id' => $user->id],
            [
                'name' => 'Chanchamayo Adventures',
                'slug' => 'chanchamayo-adventures',
                'ruc' => '20876543210',
                'description' => 'Empresa líder en turismo de aventura y ecoturismo en Chanchamayo',
                'status' => 'active',
                'phone' => '+51 999 888 777',
                'email' => 'info@chanchamayoadventures.com',
                'address' => 'Jr. Amazonas 123, La Merced, Chanchamayo',
                'city' => 'La Merced',
                'region' => 'Junín',
                'contact_person' => 'Equipo Chanchamayo Adventures',
                'registration_status' => 'approved',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'submitted_at' => now(),
            ]
        );

        // Obtener categorías
        $aventura = TourCategory::where('slug', 'aventura-deportes-extremos')->first();
        $ecoturismo = TourCategory::where('slug', 'ecoturismo')->first();
        $gastronomico = TourCategory::where('slug', 'turismo-gastronomico')->first();

        // Tours de ejemplo
        $tours = [
            [
                'title' => 'Catarata El Tirol y Aguas Termales',
                'slug' => 'catarata-el-tirol-aguas-termales',
                'description' => 'Una experiencia única que combina aventura y relajación. Visitaremos la impresionante Catarata El Tirol, una de las más hermosas de Chanchamayo, seguido de un relajante baño en aguas termales naturales. El tour incluye caminata por senderos naturales, almuerzo típico y tiempo libre para disfrutar de la naturaleza.',
                'company_id' => $company->id,
                'tour_category_id' => $aventura ? $aventura->id : 1,
                'price' => 150.00,
                'child_price' => 80.00,
                'duration_days' => 1,
                'duration_hours' => 8,
                'min_participants' => 4,
                'max_participants' => 12,
                'difficulty_level' => 'moderate',
                'included_services' => [
                    'Transporte ida y vuelta',
                    'Guía profesional',
                    'Almuerzo típico',
                    'Entrada a aguas termales',
                    'Botella de agua',
                    'Seguro de accidentes'
                ],
                'excluded_services' => [
                    'Bebidas alcohólicas',
                    'Propinas',
                    'Gastos personales'
                ],
                'itinerary' => 'Recojo a las 7:00 AM - Caminata a la catarata - Almuerzo típico - Aguas termales - Retorno 4:00 PM',
                'gallery' => [
                    'https://images.unsplash.com/photo-1508672019048-805c876b67e2?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1507499739999-097706ad8914?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1504196606672-aef5c9cefc92?auto=format&fit=crop&w=1200&q=80',
                ],
                'main_image' => 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=1200&q=80',

                'status' => 'active',
                'is_featured' => true,
                'tags' => ['aventura', 'naturaleza', 'aguas termales', 'catarata', 'relajación'],
                'meeting_points' => [
                    'Plaza de Armas La Merced',
                    'Terminal Terrestre Chanchamayo',
                    'Hotel Villa Rica'
                ],
                'rating' => 4.8,
                'total_reviews' => 45,
            ],
            [
                'title' => 'Ruta del Café Gourmet',
                'slug' => 'ruta-cafe-gourmet',
                'description' => 'Descubre los secretos del mejor café del mundo en esta experiencia única por las plantaciones de Chanchamayo. Aprende sobre el proceso completo desde la siembra hasta la taza, participa en la cosecha y degusta diferentes variedades de café premium.',
                'company_id' => $company->id,
                'tour_category_id' => $gastronomico ? $gastronomico->id : 2,
                'price' => 120.00,
                'child_price' => 60.00,
                'duration_days' => 1,
                'duration_hours' => 6,
                'min_participants' => 2,
                'max_participants' => 15,
                'difficulty_level' => 'easy',
                'included_services' => [
                    'Transporte',
                    'Guía especializado en café',
                    'Degustación de café',
                    'Almuerzo campestre',
                    'Certificado de participación',
                    'Muestra de café para llevar'
                ],
                'excluded_services' => [
                    'Compras adicionales de café',
                    'Bebidas alcohólicas',
                    'Propinas'
                ],
                'itinerary' => 'Bienvenida 8:00 AM - Visita plantación - Proceso del café - Almuerzo campestre - Cata de café',
                'gallery' => [
                    'https://images.unsplash.com/photo-1504753793650-d4a2b783c15e?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?auto=format&fit=crop&w=1200&q=80',
                ],
                'main_image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1200&q=80',
                'status' => 'active',
                'is_featured' => false,
                'tags' => ['café', 'gastronomía', 'cultura', 'plantación', 'degustación'],
                'rating' => 4.9,
                'total_reviews' => 32,
            ],
            [
                'title' => 'Aventura en Puente Colgante Kimiri',
                'slug' => 'aventura-puente-kimiri',
                'description' => 'Vive la adrenalina al máximo cruzando uno de los puentes colgantes más largos de la región. Esta aventura incluye tirolesa, rappel y caminata por senderos de la selva alta con vistas panorámicas espectaculares.',
                'company_id' => $company->id,
                'tour_category_id' => $aventura ? $aventura->id : 1,
                'price' => 180.00,
                'child_price' => 100.00,
                'duration_days' => 1,
                'duration_hours' => 7,
                'min_participants' => 6,
                'max_participants' => 10,
                'difficulty_level' => 'hard',
                'included_services' => [
                    'Equipo de seguridad completo',
                    'Instructor especializado',
                    'Transporte 4x4',
                    'Almuerzo energético',
                    'Seguro de aventura',
                    'Certificado de participación'
                ],
                'excluded_services' => [
                    'Ropa especializada',
                    'Cámara deportiva',
                    'Bebidas energéticas adicionales'
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1523419409543-0c1df022bdd1?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1526481280695-3c46903f1b34?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
                ],
                'main_image' => 'https://images.unsplash.com/photo-1570126646281-5ec881e1ece4?auto=format&fit=crop&w=1200&q=80',
                'status' => 'active',
                'is_featured' => true,
                'tags' => ['aventura', 'adrenalina', 'puente colgante', 'tirolesa', 'rappel'],
                'rating' => 4.7,
                'total_reviews' => 28,
            ]
        ];

        foreach ($tours as $tourData) {
            Tour::updateOrCreate(
                ['slug' => $tourData['slug']],
                $tourData
            );
        }
    }
}
