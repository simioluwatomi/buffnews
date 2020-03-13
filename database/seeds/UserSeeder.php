<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = Role::all();

        $roles->each(function ($role) {
            factory(User::class, 10)->create(['role_id' => $role->id]);
        });
    }
}
