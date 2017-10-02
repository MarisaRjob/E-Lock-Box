<?php

use Illuminate\Database\Seeder;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        DB::table('code')->delete();
        DB::table('profile')->delete();

        Sentinel::registerAndActivate([
            'email'    => 'it@livingadvantageinc.org',
            'password' => 'elockboxdemo2017',
            'first_name' => 'IT',
            'last_name' => 'Living Advantage Inc.',
        ]);

        $adminUser1 = Sentinel::findByCredentials(['login' => 'it@livingadvantageinc.org']);
        $adminRole = Sentinel::findRoleByName('Admins');
        $adminRole->users()->attach($adminUser1);

        DB::table('code')->insert([
            'user_id' => $adminUser1->id,
            'code' => '100000000'
        ]);

        DB::table('profile')->insert([
            'user_id' => $adminUser1->id,
        ]);

        Sentinel::registerAndActivate([
            'email'    => 'livingadvantageelockbox@gmail.com',
            'password' => 'ElockboxTeam10USC',
            'first_name' => 'Developer',
            'last_name' => 'Tester',
        ]);

        $adminUser2 = Sentinel::findByCredentials(['login' => 'livingadvantageelockbox@gmail.com']);
        $adminRole->users()->attach($adminUser2);

        DB::table('code')->insert([
            'user_id' => $adminUser2->id,
            'code' => '100000000'
        ]);

        DB::table('profile')->insert([
            'user_id' => $adminUser2->id,
        ]);

        $this->command->info('Initial users seeded!');
    }
}
