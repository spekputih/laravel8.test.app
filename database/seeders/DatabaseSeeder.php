<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\Comment;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\BlogPostTableSeeder;
use Database\Seeders\CommentTableSeeder;

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

        if($this->command->confirm('Do you want to refresh the database?')){
            $this->command->call('migrate:refresh');
            $this->command->info('The database has been refreshed!');
        }

        //  Using the 'call([])' method allows you to break up your database seeding into multiple files 
        //  so that no single seeder class becomes too large
        //  The order of the seeder file is important as it is to determine which table need to be seed first
        $this->call([
            UserTableSeeder::class,
            BlogPostTableSeeder::class,
            CommentTableSeeder::class
        ]);

    }
}
