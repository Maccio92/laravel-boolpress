<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Model\Post;
use App\Model\Category;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
        $post = new Post();
        $post->title = $faker->sentence(3, true);
        $post->author = $faker->words(2, true);
        $post->content = $faker->text();
        $title = "$post->title-$i";
        $post->slug = Str::slug($title, '-');
        $post->user_id = User::inRandomOrder()->first()->id;
        $post->category_id = Category::inRandomOrder()->first()->id;
        $post->save();
        }
    }
}
