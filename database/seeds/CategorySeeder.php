<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        factory(Category::class, 30)->create()->each(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
