<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attendence;
use App\Models\Certificate;
use App\Models\Certificates;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class CertificatesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $certificates = [
      ['id' => 7,'id_student_group'=>1,'student_id'=> 56, 'project_id' => 8, 'file_name' => 'Créer un BMC', 'created_at' => '2024-11-15 06:20:54', 'updated_at' => '2024-11-15 06:20:54'],
      ['id' => 8,'id_student_group'=>1,'student_id'=> 57, 'project_id' => 8, 'file_name' => 'Étape de préparation du prototype', 'created_at' => '2024-11-15 06:35:40', 'updated_at' => '2024-11-15 06:35:40'],
      ['id' => 9,'id_student_group'=>1,'student_id'=> 58, 'project_id' => 8, 'file_name' => 'Étape de préparation du prototype', 'created_at' => '2024-11-15 06:51:41', 'updated_at' => '2024-11-15 06:51:41'],
      ['id' => 10,'id_student_group'=>1,'student_id'=> 59, 'project_id' => 17, 'file_name' => 'Étape de préparation du prototype', 'created_at' => '2024-12-12 07:55:40', 'updated_at' => '2024-12-12 07:55:40'],
      ['id' => 11,'id_student_group'=>1,'student_id'=> 60, 'project_id' => 17, 'file_name' => 'Étape de préparation du prototype', 'created_at' => '2024-12-12 07:55:58', 'updated_at' => '2024-12-12 07:55:58'],
      ['id' => 12,'id_student_group'=>1,'student_id'=> 56, 'project_id' => 13, 'file_name' => 'Étape de formation', 'created_at' => '2024-12-13 16:47:02', 'updated_at' => '2024-12-13 16:47:02'],
      ['id' => 13,'id_student_group'=>1,'student_id'=> 57, 'project_id' => 13, 'file_name' => 'Créer un BMC', 'created_at' => '2024-12-13 17:35:56', 'updated_at' => '2024-12-13 17:35:56'],
      ['id' => 14,'id_student_group'=>1,'student_id'=> 58, 'project_id' => 17, 'file_name' => 'Étape de discussion', 'created_at' => '2024-12-13 17:48:13', 'updated_at' => '2024-12-13 17:48:13'],
      ['id' => 15,'id_student_group'=>1,'student_id'=> 59, 'project_id' => 17, 'file_name' => 'Label est un projet innovant', 'created_at' => '2024-12-13 17:49:58', 'updated_at' => '2024-12-13 17:49:58'],
    ];
    Certificate::insert($certificates);
  }
}
