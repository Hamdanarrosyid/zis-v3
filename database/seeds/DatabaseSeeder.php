<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PencapainTableSeeder::class,NilaiTableSeeder::class]);
        DB::table('tingkatbaca')->insert([
            ['tingkat_baca' => 'Iqro'],
            ['tingkat_baca' => 'Al-Quran'],
        ]);
    }
}
