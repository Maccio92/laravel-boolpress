<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Model\Post;

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
        $post->slug = Str::slug($post->title . '-' . $i, '-');
        $post->save();
        }
    }
}
