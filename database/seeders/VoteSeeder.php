<?php

namespace Database\Seeders;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['insufficiente', 'sufficiente', 'buono', 'ottimo', 'eccellente'];
        $values = [1, 2, 3, 4, 5];

        foreach ($names as $key => $name) {
            Vote::create([
                'name' => $name,
                'value' => $values[$key],
            ]);
        }
    }
}
