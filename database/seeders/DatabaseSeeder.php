<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BlogPost;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // states: is a tools that laravel offer to create your own information other than what faker has offer you.
        // so that you can specify you own user or data.
        // Example: suspended() is a states method defined in userFactory file
        // $users = User::factory()->count(5)->suspended()->make();

        $afiq_syazwan = User::factory()->user_default()->create();
        $else = User::factory()->count(50)->create();
        // dd(get_class($afiq_syazwan), get_class($else));
        $users = $else->concat([$afiq_syazwan]);
        // dd($users->count());

        // 1. get the 'posts' collection by making the model instance using make()
        // 2. adjust the each post by using each() as it accepts closure and
        // 3. save the changes to database
        $posts = BlogPost::factory()->count(30)->make()->each(function($post) use ($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });


        // 1. get the 'comments' collection by making the model instance using make()
        // 2. adjust the each post by using each() as it accepts closure and
        // 3. save the changes to database

    }
}
