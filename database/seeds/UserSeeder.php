<?php

use App\Book;
use App\DetailsTransaction;
use App\Models\District;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create()->each(function ($user) {
            $faker = Faker::create('en_GB');
            for ($i = 0; $i < rand(1, 5); $i++) {
                $phoneNumber = $faker->phoneNumber;
                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'invoice' => Str::random(),
                    'customer_name' => $user->name,
                    'customer_phone' => $phoneNumber,
                    'customer_address' => $faker->address,
                    'district_id' => District::inRandomOrder()->first()->id,
                    'sub_total' => $faker->randomNumber(),
                ]);

                for ($j = 0; $j < rand(1, 3); $j++) {
                    $book = Book::inRandomOrder()->first();
                    $quantity = rand(1, $book->stock);
                    DetailsTransaction::create([
                        'book_id' => $book->id,
                        'transaction_id' => $transaction->id,
                        'quantity' => $quantity,
                        'price' => $book->price * $quantity,
                        'weight' => $book->weight * $quantity
                    ]);
                }
            }
        });
    }
}
