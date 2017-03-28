<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::unguard();

        Role::create([
            "name"=>"admin"
        ]);
        Role::create([
            "name"=>"manager"
        ]);
        Role::create([
            "name"=>"user"
        ]);
    }
}
