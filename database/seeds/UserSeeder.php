<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Pavel Kostyuk",
            "email"=> "pavel@admin.com",
            "password" => bcrypt("admin"),
            'remember_token' => str_random(10),

        ]);

        User::create([
            "name" => "Ivan Petrov",
            "email"=> "ivan@lead.com",
            "password" => bcrypt("admin"),
            'remember_token' => str_random(10),
        ]);

        User::create([
            "name" => "Sanya Bursov",
            "email"=> "sanya@dev.com",
            "password" => bcrypt("admin"),
            'remember_token' => str_random(10),

        ]);

        $user = App\User::find(1);

        $user->roles()->attach(1);

        $user = App\User::find(2);

        $user->roles()->attach(2);


        $user = App\User::find(3);

        $user->roles()->attach(3);
    }
}
