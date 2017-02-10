<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pelaku = ['admin','teknisi'];

      foreach ($pelaku as $key => $value) {
        Role::create([
          'role_name' => $value
        ]);
      }

    }
}
