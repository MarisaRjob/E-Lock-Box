<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('document_list')->delete();
        DB::table('document_list')->insert([
            'document_abbr' => 'DL',
            'document_type' => 'Driver License',
        ]);
        DB::table('document_list')->insert([
            'document_abbr' => 'SSN',
            'document_type' => 'Social Security Number',
        ]);


        $this->command->info('Document Type seeded!');
    }
}
