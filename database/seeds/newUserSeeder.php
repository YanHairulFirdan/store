<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class newUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ID-id');
        User::create([
            'name' => $faker->name,
            'email' => 'user@mail.com',
            'password' => Hash::make('user123pass')
        ]);
    }
}
