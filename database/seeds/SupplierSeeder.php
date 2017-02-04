<?php

use Illuminate\Database\Seeder;

use App\Supplier;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Supplier::create([
        'supplier_name' => 'BOS',
        'keterangan' => 'dari BOS (Bantuan Operasional Sekolah)'
      ]);

      Supplier::create([
        'supplier_name' => 'ISS',
        'keterangan' => 'dari ISS (Integwejfewifjp)'
      ]);
    }
}
