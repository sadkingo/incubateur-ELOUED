<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attendence;
use App\Models\Student;
use App\Models\SupervisingTeacherProject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class SupervisingTeacherProjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $SupervisingTeacherProjects = [
      ['id' => 1, 'id_student' => 31, 'faculty_id' => 1, 'id_project' => 8, 'id_supervisor' => 1, 'created_at' => '2024-07-16 15:59:08', 'updated_at' => '2024-10-18 18:30:00', ],
      ['id' => 2, 'id_student' => 32, 'faculty_id' => 1, 'id_project' => 2, 'id_supervisor' => 2, 'created_at' => '2024-07-22 10:37:03', 'updated_at' => '2024-07-22 10:37:03', ],
      ['id' => 3, 'id_student' => 34, 'faculty_id' => 1, 'id_project' => 4, 'id_supervisor' => 3, 'created_at' => '2024-07-22 14:49:02', 'updated_at' => '2024-07-22 14:49:02', ],
    ];
    SupervisingTeacherProject::insert($SupervisingTeacherProjects);
  }
}
