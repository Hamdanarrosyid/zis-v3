<?php

use Illuminate\Database\Seeder;

class TingkatbacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tingkatbaca')->insert([
            ['tingkat_baca' => 'Iqro','nama_tingkatan'=>'jilid'],
            ['tingkat_baca' => 'Al-Quran','nama_tingkatan'=>'juz'],
        ]);
    }
}
