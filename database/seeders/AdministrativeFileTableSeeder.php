<?php

namespace Database\Seeders;

use App\Models\AdministrativeFiles;
use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministrativeFileTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    AdministrativeFiles::create([
      'id' => 9,
      'student_id' => 52,
      'project_id' => 8,
      'registration_certificate' => '1731667485_registration_certificate_0.pdf',
      'identification_card' => '1731667485_identification_card_0.pdf',
      'photo' => '1731667485_photo_0.jpg',
      'status' => 1,
      'created_at' => '2024-11-15 09:44:46',
      'updated_at' => '2024-11-15 10:00:49',
    ]);
  }
}
