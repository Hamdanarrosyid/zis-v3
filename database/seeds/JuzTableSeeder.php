<?php

use Illuminate\Database\Seeder;

class JuzTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($a = 1; $a <= 30; $a++) {
            DB::table('juz')->insert(['jus' => $a]);
        }
    }
}
