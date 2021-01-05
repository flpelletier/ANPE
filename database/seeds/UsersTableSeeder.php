<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Administrateur',
            'surname' => 'Global',
            'email' => 'tplaravel284@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'email_verified_at' => now(),
            ]);

        $role = Role::create(['name' => 'Administrateur']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $user1 = User::create([
            'name' => 'Utilisateur',
            'surname' => 'Test',
            'email' => 'pelletier.ft1@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'email_verified_at' => now(),
        ]);
    }
}
