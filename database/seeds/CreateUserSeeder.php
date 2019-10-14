<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::create(['name' => 'User']);

        $permissions = Permission::where('name','task-list')->first();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
