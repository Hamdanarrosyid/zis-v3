<?php

use Illuminate\Database\Seeder;

class JenisZisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_zis')->insert([
            'jenis' => 'Infaq malam Jumat',
        ]);
    }
}
