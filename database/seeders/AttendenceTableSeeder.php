<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attendence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AttendenceTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $attendees = [
      ['id' => 1, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 2, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 2, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 2, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 3, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 2, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 4, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 2, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 5, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 2, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 6, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 2, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 7, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 2, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 8, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 2, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 9, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 2, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 10, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 2, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 11, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 2, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 12, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 2, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 13, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 2, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 14, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 2, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 15, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 2, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 16, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 2, 'week' => 5, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 17, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 3, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 18, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 3, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 19, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 3, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 20, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 3, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 21, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 3, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 22, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 3, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 23, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 3, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 24, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 3, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 25, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 3, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 26, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 3, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 27, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 3, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 28, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 3, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 29, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 3, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 30, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 3, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 31, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 3, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 32, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 3, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 33, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 3, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 34, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 3, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 35, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 3, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 36, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 3, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 37, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 3, 'week' => 5, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 38, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 4, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 39, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 4, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 40, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 4, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 41, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 4, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 42, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 4, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 43, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 4, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 44, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 4, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 45, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 4, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 46, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 4, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 47, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 4, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 48, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 4, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 49, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 4, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 50, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 4, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 51, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 4, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 52, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 4, 'week' => 3, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 53, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 4, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 54, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 4, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 55, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 4, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 56, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 4, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 57, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 4, 'week' => 4, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 58, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 4, 'week' => 5, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 59, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 4, 'week' => 5, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 60, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 5, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 61, 'student_id' => 52, 'day' => 5, 'year' => 2024, 'month' => 5, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 62, 'student_id' => 52, 'day' => 1, 'year' => 2024, 'month' => 5, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 63, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 5, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 64, 'student_id' => 52, 'day' => 3, 'year' => 2024, 'month' => 5, 'week' => 1, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 65, 'student_id' => 52, 'day' => 4, 'year' => 2024, 'month' => 5, 'week' => 2, 'number' => 3, 'created_at' => '2024-05-08 09:00:13', 'updated_at' => '2024-05-08 09:00:13', 'deleted_at' => NULL],
      ['id' => 66, 'student_id' => 62, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 2, 'number' => 3, 'created_at' => '2024-06-09 03:22:57', 'updated_at' => '2024-06-09 03:22:57', 'deleted_at' => NULL],
      ['id' => 67, 'student_id' => 62, 'day' => 2, 'year' => 2024, 'month' => 6, 'week' => 2, 'number' => 3, 'created_at' => '2024-06-09 03:22:57', 'updated_at' => '2024-06-09 03:22:57', 'deleted_at' => NULL],
      ['id' => 68, 'student_id' => 63, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 2, 'number' => 3, 'created_at' => '2024-06-09 03:54:41', 'updated_at' => '2024-06-09 03:54:41', 'deleted_at' => NULL],
      ['id' => 69, 'student_id' => 64, 'day' => 2, 'year' => 2024, 'month' => 6, 'week' => 2, 'number' => 3, 'created_at' => '2024-06-09 03:54:41', 'updated_at' => '2024-06-09 03:54:41', 'deleted_at' => NULL],
      ['id' => 70, 'student_id' => 64, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 2, 'number' => 3, 'created_at' => '2024-06-09 18:53:46', 'updated_at' => '2024-06-09 18:53:46', 'deleted_at' => NULL],
      ['id' => 71, 'student_id' => 55, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 4, 'number' => 3, 'created_at' => '2024-06-23 21:50:19', 'updated_at' => '2024-06-23 21:50:19', 'deleted_at' => NULL],
      ['id' => 72, 'student_id' => 56, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 4, 'number' => 3, 'created_at' => '2024-06-23 21:57:02', 'updated_at' => '2024-06-23 21:57:02', 'deleted_at' => NULL],
      ['id' => 73, 'student_id' => 57, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 4, 'number' => 3, 'created_at' => '2024-06-23 22:11:30', 'updated_at' => '2024-06-23 22:11:30', 'deleted_at' => NULL],
      ['id' => 74, 'student_id' => 58, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 4, 'number' => 3, 'created_at' => '2024-06-23 22:15:13', 'updated_at' => '2024-06-23 22:15:13', 'deleted_at' => NULL],
      ['id' => 75, 'student_id' => 59, 'day' => 1, 'year' => 2024, 'month' => 6, 'week' => 4, 'number' => 3, 'created_at' => '2024-06-23 22:28:39', 'updated_at' => '2024-06-23 22:28:39', 'deleted_at' => NULL],
      ['id' => 76, 'student_id' => 60, 'day' => 3, 'year' => 2024, 'month' => 7, 'week' => 1, 'number' => 3, 'created_at' => '2024-07-02 10:14:54', 'updated_at' => '2024-07-02 10:14:54', 'deleted_at' => NULL],
      ['id' => 77, 'student_id' => 61, 'day' => 1, 'year' => 2024, 'month' => 7, 'week' => 1, 'number' => 3, 'created_at' => '2024-07-07 15:44:18', 'updated_at' => '2024-07-07 15:44:18', 'deleted_at' => NULL],
      ['id' => 78, 'student_id' => 62, 'day' => 1, 'year' => 2024, 'month' => 7, 'week' => 1, 'number' => 3, 'created_at' => '2024-07-07 15:56:18', 'updated_at' => '2024-07-07 15:56:18', 'deleted_at' => NULL],
      ['id' => 79, 'student_id' => 63, 'day' => 4, 'year' => 2024, 'month' => 7, 'week' => 2, 'number' => 3, 'created_at' => '2024-07-10 11:17:01', 'updated_at' => '2024-07-10 11:17:01', 'deleted_at' => NULL],
      ['id' => 80, 'student_id' => 64, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 3, 'number' => 3, 'created_at' => '2024-07-15 11:48:28', 'updated_at' => '2024-07-15 11:48:28', 'deleted_at' => NULL],
      ['id' => 81, 'student_id' => 52, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 3, 'number' => 3, 'created_at' => '2024-07-15 11:56:04', 'updated_at' => '2024-07-15 11:56:04', 'deleted_at' => NULL],
      ['id' => 82, 'student_id' => 53, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 3, 'number' => 3, 'created_at' => '2024-07-15 11:59:59', 'updated_at' => '2024-07-15 11:59:59', 'deleted_at' => NULL],
      ['id' => 83, 'student_id' => 54, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 3, 'number' => 3, 'created_at' => '2024-07-15 12:07:54', 'updated_at' => '2024-07-15 12:07:54', 'deleted_at' => NULL],
      ['id' => 84, 'student_id' => 55, 'day' => 3, 'year' => 2024, 'month' => 7, 'week' => 3, 'number' => 3, 'created_at' => '2024-07-16 15:34:00', 'updated_at' => '2024-07-16 15:34:00', 'deleted_at' => NULL],
      ['id' => 85, 'student_id' => 56, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 4, 'number' => 3, 'created_at' => '2024-07-22 10:33:14', 'updated_at' => '2024-07-22 10:33:14', 'deleted_at' => NULL],
      ['id' => 86, 'student_id' => 57, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 4, 'number' => 3, 'created_at' => '2024-07-22 10:44:24', 'updated_at' => '2024-07-22 10:44:24', 'deleted_at' => NULL],
      ['id' => 87, 'student_id' => 58, 'day' => 2, 'year' => 2024, 'month' => 7, 'week' => 4, 'number' => 3, 'created_at' => '2024-07-22 14:45:13', 'updated_at' => '2024-07-22 14:45:13', 'deleted_at' => NULL],
      ['id' => 88, 'student_id' => 59, 'day' => 4, 'year' => 2024, 'month' => 7, 'week' => 4, 'number' => 3, 'created_at' => '2024-07-24 06:16:06', 'updated_at' => '2024-07-24 06:16:06', 'deleted_at' => NULL],
      ['id' => 89, 'student_id' => 60, 'day' => 4, 'year' => 2024, 'month' => 10, 'week' => 3, 'number' => 3, 'created_at' => '2024-10-16 08:30:33', 'updated_at' => '2024-10-16 08:30:33', 'deleted_at' => NULL],
    ];
    Attendence::insert($attendees);
  }
}
