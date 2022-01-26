<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask('How many users would you like?', 150), 1);
        User::factory()->user_default()->create();
        User::factory()->count($usersCount)->create();
        // dd(get_class($afiq_syazwan), get_class($else));
        // $users = $else->concat([$afiq_syazwan]);
        // dd($users->count());
    }
}
