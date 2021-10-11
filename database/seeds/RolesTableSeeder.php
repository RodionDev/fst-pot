<?php
use App\Role;
use Illuminate\Database\Seeder;
class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
