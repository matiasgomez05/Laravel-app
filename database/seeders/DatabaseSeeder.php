<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // Paises
        $paises = json_decode(file_get_contents(database_path('data/paises.json')), true);
        DB::table('paises')->insert($paises);

        // Provincias
        $provincias = json_decode(file_get_contents(database_path('data/provincias.json')), true);
        DB::table('provincias')->insert($provincias);

        // Partidos
        $partidos = json_decode(file_get_contents(database_path('data/partidos.json')), true);
        DB::table('partidos')->insert($partidos);

        // Localidades
        $localidades = json_decode(file_get_contents(database_path('data/localidades.json')), true);
        DB::table('localidades')->insert($localidades);

    }
}
