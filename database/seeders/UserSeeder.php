<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            [
                'name' => 'Kalkulus Kalkulus',
                'username' => 'Kalkulus',
                'email' => 'kalkulus132@gmail.com',
                'password' => Hash::make('Kalkulus32?!')
            ]
        );

        $roles = Role::all();
        $permissions = Permission::all();

        $user->syncRoles($roles);

        $user->syncPermissions($permissions);
    }
}
