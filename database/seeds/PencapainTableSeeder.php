<?php

use Illuminate\Database\Seeder;

class PencapainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($a = 1; $a <= 30; $a++) {
            DB::table('pencapaianbaca')->insert([
                ['tingkatbaca_id' => 2,'nomor_pencapaian'=>$a],
            ]);
        }
        for ($a = 1; $a <= 6; $a++) {
            DB::table('pencapaianbaca')->insert([
                ['tingkatbaca_id' => 1,'nomor_pencapaian'=>$a],
            ]);
        }
    }
}
