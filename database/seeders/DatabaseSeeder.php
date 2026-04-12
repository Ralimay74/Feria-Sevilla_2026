<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🎪 Iniciando seeders de la Feria de Sevilla 2026...');

        // Crear usuario de prueba
        User::factory()->create([
            'name' => 'Admin Feria',
            'email' => 'raymar000@gmail.com',
            'password' => bcrypt('Ralimay74@'),
        ]);

        // Ejecutar seeders de casetas
        $this->call([
            CasetaSeeder::class,
        ]);

        $this->command->info('✅ ¡Seeders completados correctamente!');
    }
}