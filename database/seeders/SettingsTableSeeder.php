<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attendence;
use App\Models\Manager;
use App\Models\Setting;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class SettingsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $settings = [
      ['id' => 1, 'name' => 'days', 'value' => '5', 'created_at' => '2024-05-07 12:18:47', 'updated_at' => '2024-05-07 12:18:47',],
      ['id' => 2, 'name' => 'groups', 'value' => '8', 'created_at' => '2024-05-07 12:18:47', 'updated_at' => '2024-05-07 12:18:47',],
      ['id' => 3, 'name' => 'specialization', 'value' => 'إعلام', 'created_at' => '2024-05-07 12:20:18', 'updated_at' => '2024-05-07 12:20:18',],
      ['id' => 4, 'name' => 'branch', 'value' => 'الاعلام والاتصال', 'created_at' => '2024-05-07 12:20:18', 'updated_at' => '2024-05-07 12:20:18',],
      ['id' => 5, 'name' => 'promotion', 'value' => 'أفريل 2023', 'created_at' => '2024-05-07 12:22:25', 'updated_at' => '2024-05-07 12:22:25',],
      ['id' => 6, 'name' => 'batchs', 'value' => '3', 'created_at' => '2024-05-07 12:22:25', 'updated_at' => '2024-05-07 12:22:25',],
      ['id' => 7, 'name' => 'start_date', 'value' => '2021', 'created_at' => '2024-05-07 12:23:30', 'updated_at' => '2024-05-07 12:23:30',],
      ['id' => 8, 'name' => 'email', 'value' => 'kaidnews@gmail.com', 'created_at' => '2024-05-07 12:23:30', 'updated_at' => '2024-05-07 12:23:30',],
      ['id' => 9, 'name' => 'fax', 'value' => '032124353', 'created_at' => '2024-05-07 12:24:35', 'updated_at' => '2024-05-07 12:24:35',],
      ['id' => 10, 'name' => 'phone', 'value' => '0770988020', 'created_at' => '2024-05-07 12:24:35', 'updated_at' => '2024-05-07 12:24:35',],
      ['id' => 11, 'name' => 'project_count', 'value' => '2', 'created_at' => '2023-11-15 06:39:22', 'updated_at' => '2024-11-15 06:08:25',],
    ];
    Setting::insert($settings);
  }
}
