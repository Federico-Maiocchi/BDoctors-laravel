<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specializations = [
            'Neurologia',
            'Neuropsichiatria infantile',
            'Psichiatria',
            'Dermatologia',
            'Cardiologia',
            'Ortopedia',
            'Gastroenterologia',
            'Oncologia',
            'Endocrinologia',
            'Nefrologia',
            'Oculistica',
            'Pediatria',
            'Chirurgia generale',
            'Radiologia',
            'Ginecologia',
            'Urologia',
            'Pneumologia',
            'Otorinolaringoiatria',
            'Reumatologia',
            'Allergologia'
        ];

        foreach ($specializations as $specialization) {
           $new_specialization = new Specialization();
           $new_specialization->name = $specialization;
           $new_specialization->save();
        }
    }
}