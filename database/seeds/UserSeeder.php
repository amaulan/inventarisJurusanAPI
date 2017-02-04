<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'username' => 'admin',
        'password' => bcrypt('admin'),
        'fullname' => 'Admin',
        'role_id'  => 1,
      ]);

      User::create([
        'username' => 'user_1',
        'password' => app('hash')->make('user_1'),
        'fullname' => 'User',
        'role_id'  => 2,
      ]);
    }
}
