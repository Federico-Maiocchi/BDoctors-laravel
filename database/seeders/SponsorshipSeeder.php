<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $types = ['un giorno', 'due giorni', 'una settimana'];
        $prices = [2.99, 5.99, 9.99];
        $durations = [24, 72, 144]; 

        foreach ($types as $key => $type) {
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->type = $type;
            $new_sponsorship->price = $prices[$key];
            $new_sponsorship->duration = $durations[$key];
            $new_sponsorship->save();
        }
    }
}