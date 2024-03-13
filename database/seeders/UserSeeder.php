<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $new_user = new User();
            $new_user->name = $faker->firstName();
            $new_user->surname = $faker->lastName();
            $new_user->email = $faker->email();
            $new_user->password = Hash::make('admin123');
            $new_user->save();
        }

        $user = User::create([
            'name' => 'Cristoforo',
            'surname' => 'Colombo',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
