<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->delete();

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admins',
            'slug' => 'admins',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Managers',
            'slug' => 'managers',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Staff',
            'slug' => 'staff',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Youths',
            'slug' => 'youths',
        ]);

        $this->command->info('Roles seeded!');
    }
}
