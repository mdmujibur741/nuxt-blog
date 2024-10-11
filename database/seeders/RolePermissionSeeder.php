<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('password');
        $user->save();

        $role = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $permission = [
             ['name' => 'user list'],
             ['name' => 'user create'],
             ['name' => 'user show'],
             ['name' => 'user delete'],

             ['name' => 'role list'],
             ['name' => 'role create'],
             ['name' => 'role show'],
             ['name' => 'role delete'],



             ['name' => 'blog list'],
             ['name' => 'blog create'],
             ['name' => 'blog show'],
             ['name' => 'blog delete'],




             ['name' => 'setting list'],
             ['name' => 'setting create'],
             ['name' => 'setting show'],
             ['name' => 'setting delete'],

             ['name' => 'default'],
             ['name' => 'dashboard'],
             ['name' => 'user home'],
        ];

        foreach($permission as $per){
             Permission::create($per);
        }

        $role->syncPermissions(Permission::all());
        $user = User::first();
        $user->assignRole($role);
    }
}