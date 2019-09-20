<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        //$adminRole = Role::where('nombre', 'admin')->first();
        //$authorRole = Role::where('nombre', 'author')->first();
        //$userRole = Role::where('name', 'user')->first();
      
        $admin = User::create([
            'nombre' => 'Jonathan',
            'apellido' => 'Moran',
            'usuario' => 'tatan',            
            'password' => bcrypt('123'),
            'telefono' => '2402541',
            'dui' => '12345'
        ]);

        /*$author = User::create([
            'nombre' => 'Carlos',
            'apellido' => 'Perez',
            'usuario' => 'perez',            
            'password' => bcrypt('author'),
            'telefono' => '521452',
            'dui' => '123458475'
        ]);*/

        /*$user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);*/

        //$admin->roles()->attach($adminRole);
        //$author->roles()->attach($authorRole);
        //$user->roles()->attach($userRole);
    }
}
