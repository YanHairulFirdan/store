<?php

use App\Book;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *T
     * @return void
     */
    public function run()
    {
        factory(Book::class, 100)->create();
    }
}
