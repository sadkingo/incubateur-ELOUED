<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $managers = [
      ['id' => 2, 'faculty_id' => 7, 'firstname_ar' => 'elhareth', 'lastname_ar' => 'csdcs', 'phone' => '079594128', 'email' => 'manager@gmail.com', 'password' => '$2y$10$0Kj3ecJtDdWmgX4n7uWe9ut22nSXiBKNl4L6y3y71yFZHVzsTkv2u', 'created_at' => '2024-11-01 15:23:53', 'updated_at' => '2024-11-07 08:40:00',],
      ['id' => 3, 'faculty_id' => 7, 'firstname_ar' => 'elhareth', 'lastname_ar' => 'csdcs', 'phone' => '0795909129', 'email' => 'manager2@gmail.com', 'password' => '$2y$10$ZkrXgAHwDEwYX4dIhWCLf.kljI5JLC1sJwrsvWi.WHB6lND9UyOyi', 'created_at' => '2024-11-07 08:40:26', 'updated_at' => '2024-11-07 08:40:26',],
      ['id' => 4, 'faculty_id' => 6, 'firstname_ar' => 'elhareth', 'lastname_ar' => 'csdcs', 'phone' => '0795909126', 'email' => 'manager3@gmail.com', 'password' => '$2y$10$8S7GXsKdmvJ4nv8RJ4aqj.JTvx/G0XsmSnFX1EJAb5u9wQR029Pry', 'created_at' => '2024-11-07 09:10:57', 'updated_at' => '2024-11-07 09:10:57',],
    ];
    Manager::insert($managers);
  }
}
