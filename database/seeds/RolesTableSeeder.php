<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['nombre' => 'admin']);
        Role::create(['nombre' => 'author']);
        //Role::create(['name' => 'user']);
    }
}
