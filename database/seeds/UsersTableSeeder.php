<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = factory(User::class)->create([
            'name' => 'God',
            'email' => 'god@test.pt',
            'password' => bcrypt('secret'),
        ]);
    }
}