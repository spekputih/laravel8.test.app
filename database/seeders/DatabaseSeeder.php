<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

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

        // DB::table('users')->insert([
        //     'name' => $this->faker->name,
        //     'email' => $this->faker->unique()->safeEmail,
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        User::factory()->user_default()->create();
        User::factory()
            ->count(50)
            ->create();
    }
}
