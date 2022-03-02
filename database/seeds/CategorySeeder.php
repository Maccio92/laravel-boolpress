<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Model\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for ($i=0; $i < 5; $i++) { 
            $category = new Category();
            $category->name = $faker->words(3, true);
            $title = "$category->name-$i";
            $category->slug = Str::slug($title, '-');
            $category->save();
            }
    }
}
