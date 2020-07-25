<?php

use Illuminate\Database\Seeder;

class PemasukanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pemasukan_zis')->insert([
            'jenis_id' => 1,
            'tanggal' => '2002-01-02',
            'nominal' => 20000,
            'user_id'=>1,
        ]);
    }
}
