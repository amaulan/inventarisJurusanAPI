<?php

use Illuminate\Database\Seeder;

use App\Jurusan;


class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Jurusan::create([
        'jurusan_name' => 'Rekayasa Perangkat Lunak'
      ]);

      Jurusan::create([
        'jurusan_name' => 'Teknik Komputer & Jaringan'
      ]);
    }
}
