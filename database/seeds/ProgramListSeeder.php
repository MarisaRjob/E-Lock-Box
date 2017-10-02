<?php

use Illuminate\Database\Seeder;

class ProgramListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('program_list')->delete();
        DB::table('program_list')->insert([
            'program_abbr' => 'P1',
            'program_name' => 'Program1',
        ]);
        DB::table('program_list')->insert([
            'program_abbr' => 'P2',
            'program_name' => 'Program2',
        ]);


        $this->command->info('Program seeded!');
    }
}
