<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;


class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $postsCount = (int)$this->command->ask('How many posts would you like?', 200);
        // 1. get the 'posts' collection by making the model instance using make()
        // 2. adjust the each post by using each() as it accepts closure and
        // 3. save the changes to database
        $users = User::all();
        BlogPost::factory()->count($postsCount)->make()->each(function($post) use ($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });

    }
}
