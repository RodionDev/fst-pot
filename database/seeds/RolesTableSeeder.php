<?php
use App\Role;
use Illuminate\Database\Seeder;
class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Superadmin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Tester']);
        Role::create(['name' => 'Dummy']);
    }
}
