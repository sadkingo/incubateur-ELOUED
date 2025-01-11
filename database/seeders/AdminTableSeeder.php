<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Admin::create([
      'name' => 'Admin',
      'email' => 'admin@gmail.com',
      'phone' => '0775805470',
      'password' => '123456789',
      'email_verified_at' => now()
    ]);
  }
}
