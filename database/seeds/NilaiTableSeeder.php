<?php

use Illuminate\Database\Seeder;

class NilaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nilai')->insert([
            ['nilai' => 'A'],
            ['nilai' => 'B'],
            ['nilai' => 'C'],
        ]);
    }
}
