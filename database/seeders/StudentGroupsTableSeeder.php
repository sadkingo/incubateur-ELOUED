<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attendence;
use App\Models\Manager;
use App\Models\Setting;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class StudentGroupsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //    sql data does not match the migration
    //    $studentGroups = [
    //      ['id' => 31, 'student_id' => 52, 'project_id' => 8, 'created_at' => '2024-11-15 09:59:39', 'updated_at' => '2024-11-15 09:59:38',],
    //      ['id' => 33, 'student_id' => 57, 'project_id' => 17, 'created_at' => '2024-12-12 07:23:42', 'updated_at' => '2024-12-12 07:23:42',],
    //    ];
    //    StudentGroup::insert($studentGroups);
  }
}
