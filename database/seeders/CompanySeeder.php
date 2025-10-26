<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear empresas de turismo
        $companies = [
            [
                'name' => 'Chanchamayo Adventure Tours',
                'email' => 'admin@chanchamayoadventure.com',
                'ruc' => '20567890123',
                'phone' => '+51 999 888 777',
                'address' => 'Jr. Los Andes 123, La Merced, Chanchamayo',
                'description' => 'Especialistas en turismo de aventura y naturaleza en la selva central del Perú.',
                'city' => 'La Merced',
                'region' => 'Junín',
            ],
            [
                'name' => 'Selva Verde Expeditions',
                'email' => 'info@selvaverde.com',
                'ruc' => '20123456789',
                'phone' => '+51 987 654 321',
                'address' => 'Av. Mariscal Castilla 456, San Ramón, Chanchamayo',
                'description' => 'Tours ecológicos y sostenibles en la amazonía peruana.',
                'city' => 'San Ramón',
                'region' => 'Junín',
            ],
            [
                'name' => 'Andes Amazon Tours',
                'email' => 'contact@andesamazon.com',
                'ruc' => '20987654321',
                'phone' => '+51 965 432 198',
                'address' => 'Cal. Junín 789, Perené, Chanchamayo',
                'description' => 'Tours culturales y gastronómicos en la región de Chanchamayo.',
                'city' => 'Perené',
                'region' => 'Junín',
            ]
        ];

        foreach ($companies as $companyData) {
            // Crear usuario administrador de la empresa
            $user = User::create([
                'name' => 'Admin ' . $companyData['name'],
                'email' => $companyData['email'],
                'password' => Hash::make('password123'),
                'user_type' => 'company_admin',
            ]);

            $user->forceFill(['email_verified_at' => now()])->save();

            // Crear la empresa
            Company::create([
                'user_id' => $user->id,
                'name' => $companyData['name'],
                'ruc' => $companyData['ruc'],
                'phone' => $companyData['phone'],
                'email' => $companyData['email'],
                'address' => $companyData['address'],
                'city' => $companyData['city'],
                'region' => $companyData['region'],
                'contact_person' => 'Admin ' . $companyData['name'],
                'description' => $companyData['description'],
                'status' => 'active',
                'rating' => 4.5,
                'total_reviews' => 10,
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'submitted_at' => now(),
            ]);
        }

        echo "Se crearon " . count($companies) . " empresas exitosamente.\n";
    }
}
