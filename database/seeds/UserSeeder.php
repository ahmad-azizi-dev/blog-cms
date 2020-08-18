<?php

use App\Role;
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
        $user = new User();
        $user->name = 'ahmad';
        $user->email = 'a@gmail.com';
        $user->password = bcrypt('password'); //default password must be edited!!!
        $user->status = 1;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        $user->roles()->attach($role->id);
    }
}
