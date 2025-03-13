<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pets')->insert([
            'name'       => 'Firulais',
            'kind'       => 'Dog',
            'weight'     => '16',
            'age'        => '7',
            'breed'      => 'Shiba Inu',
            'location'   => 'Kioto',
            'description'=> 'El Shiba Inu es una raza de perro originaria de Japón, conocida por su apariencia similar a un zorro, con una cola rizada y un pelaje denso. Es de tamaño pequeño a mediano, con una personalidad independiente, alerta y valiente. A pesar de su temperamento fuerte, es leal y afectuoso con su familia. El Shiba Inu es una de las razas más populares en Japón y es conocido por ser muy limpio y fácil de entrenar, aunque puede ser algo terco.',
            'created_at'=> now()
        ]);
        DB::table('pets')->insert([
            'name'       => 'Michi',
            'kind'       => 'Cat',
            'weight'     => '4',
            'age'        => '18',
            'breed'      => 'Siamés',
            'location'   => 'Osaka',
            'description'=> 'El Siamés es un gato elegante y sociable, con pelaje corto y ojos azules brillantes. Es inteligente, vocal y muy afectuoso con sus dueños.',
            'created_at'=> now()
        ]);
        DB::table('pets')->insert([
            'name'       => 'Cuca',
            'kind'       => 'Dog',
            'weight'     => '12',
            'age'        => '48',
            'breed'      => 'Pitbull',
            'location'   => 'Tokio',
            'description'=> 'El Pitbull es un perro musculoso y robusto, conocido por su lealtad y valentía. Es energético, inteligente y protector, con una personalidad cariñosa hacia su familia.',
            'created_at'=> now()
        ]);
    }
}
