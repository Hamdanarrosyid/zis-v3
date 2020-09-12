<?php

use Illuminate\Database\Seeder;

class IqroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($a = 1; $a <= 6; $a++) {
            DB::table('iqro')->insert(['jilid' => $a]);
        }
    }
}
