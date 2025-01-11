<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $students = [
      ['id' => 52, 'registration_number' => '111555', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'ss', 'firstname_ar' => 'ss', 'lastname_fr' => 'ss', 'lastname_ar' => 'ss', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-10', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2024', 'academicLevel' => 'ليسانس', 'specialty' => 'ااا', 'department' => 'GL', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66666666', 'email' => 'ee@gmail.com', 'password' => '$2y$10$XE2KAukIRdYZAfu0hnBT8OxzGcxmuKLYFSBjrS5lw3hCf9WQevKjm', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-15 08:49:41', 'updated_at' => '2024-11-15 08:49:41', 'deleted_at' => NULL],
      ['id' => 53, 'registration_number' => '111551', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'SAID', 'firstname_ar' => 'قادة', 'lastname_fr' => 'TALBI', 'lastname_ar' => 'طالبي', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-11', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2025', 'academicLevel' => 'ليسانس', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66646666', 'email' => 'eAe@gmail.com', 'password' => '$2y$10$5OjJm8ImksyVfauiHaLGneWsygSvpcTUZQopki9b5aOc.5bStza/2', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:26', 'updated_at' => '2024-11-28 10:21:26', 'deleted_at' => '2024-12-05 07:33:17'],
      ['id' => 54, 'registration_number' => '111532', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'MOSA', 'firstname_ar' => 'صالح', 'lastname_fr' => 'OUALI', 'lastname_ar' => 'والي', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-12', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ليسانس', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66644666', 'email' => 'eAAe@gmail.com', 'password' => '$2y$10$231fsesMPC3jGm0CvUf1QeqVw9hfVYiQu/cGcJJN/BUAlg1ZVpV26', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:26', 'updated_at' => '2024-11-28 10:21:26', 'deleted_at' => '2024-12-05 07:33:20'],
      ['id' => 55, 'registration_number' => '111253', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'AISA', 'firstname_ar' => 'عيسى', 'lastname_fr' => 'HIMA', 'lastname_ar' => 'هيمة', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-13', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66444666', 'email' => 'eAAAAe@gmail.com', 'password' => '$2y$10$UijG3m1yA2lf8n/OPSUPmu/chJ1IyKWrypnTeDxX5nmW6YWO.aD72', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:26', 'updated_at' => '2024-11-28 10:21:26', 'deleted_at' => NULL],
      ['id' => 56, 'registration_number' => '111554', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'BACHIR', 'firstname_ar' => 'بشير', 'lastname_fr' => 'KADOUR', 'lastname_ar' => 'قدور', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-14', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66655666', 'email' => 'eZZe@gmail.com', 'password' => '$2y$10$2Aur0cZfVWZmTCaSL4XX9OQOWBXW8s7Y4wYHeeaCb.0o43N1NS/pq', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:27', 'updated_at' => '2024-11-28 10:21:27', 'deleted_at' => '2024-12-05 07:33:16'],
      ['id' => 57, 'registration_number' => '111557', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'KHALED', 'firstname_ar' => 'خالد', 'lastname_fr' => 'LADGAM', 'lastname_ar' => 'لدغم', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-15', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66566666', 'email' => 'eEERe@gmail.com', 'password' => '$2y$10$M9HTrF0CQ9PcX2YTSyFTI.L6d3Ly7YQzWVqJnE2ZtBpBt0lPvGP86', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:27', 'updated_at' => '2024-11-28 10:21:27', 'deleted_at' => NULL],
      ['id' => 58, 'registration_number' => '111545', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'WALID', 'firstname_ar' => 'قاسم', 'lastname_fr' => 'MOUNS', 'lastname_ar' => 'مؤنس', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-16', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66596666', 'email' => 'eeEEEE@gmail.com', 'password' => '$2y$10$ptnbb107GkxFFUUD.3grxud.xMb9YyycCZaSu1vtEae8pv4e6OKt.', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:27', 'updated_at' => '2024-11-28 10:21:27', 'deleted_at' => '2024-12-05 07:33:19'],
      ['id' => 59, 'registration_number' => '111547', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'basm', 'firstname_ar' => 'باسم', 'lastname_fr' => 'mouns', 'lastname_ar' => 'مؤنس', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-17', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66595666', 'email' => 'eeErEE@gmail.com', 'password' => '$2y$10$KJvL3dlWuUCbljTQq7X93em1bfRlT32XUCxJEK9IorIsRCcgHaSle', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:28', 'updated_at' => '2024-11-28 10:21:28', 'deleted_at' => '2024-12-05 07:33:18'],
      ['id' => 60, 'registration_number' => '111537', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'oulhi', 'firstname_ar' => 'ولهي', 'lastname_fr' => 'hiama', 'lastname_ar' => 'هيمة', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-18', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66594366', 'email' => 'eeErEEE@gmail.com', 'password' => '$2y$10$7QJ3TOCaYgSGepGGKEulheQ/DK0JeyLpt0TsGrPY4E9lfuUxcDD1q', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:28', 'updated_at' => '2024-11-28 10:21:28', 'deleted_at' => '2024-12-05 07:33:19'],
      ['id' => 61, 'registration_number' => '111516', 'created_by' => NULL, 'id_faculty' => 1, 'group_id' => NULL, 'firstname_fr' => 'walid', 'firstname_ar' => 'وليد', 'lastname_fr' => 'arbi', 'lastname_ar' => 'عريبي', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2010-10-19', 'state_of_birth' => 'الوادي', 'place_of_birth' => 'الوادي', 'residence' => 'الوادي', 'group' => '2', 'batch' => '2026', 'academicLevel' => 'ماستر', 'specialty' => 'هندسة الطرائق', 'department' => 'gp', 'start_date' => "2025-01-08", 'end_date' => '2025-01-22', 'phone' => '66565666', 'email' => 'eeEErEE@gmail.com', 'password' => '$2y$10$rqr8n4VrZ9PJVvPSMG2xt.B8ngEXtOE6SVKZsrVTXjw.bPoLc1TbK', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2024-11-28 10:21:28', 'updated_at' => '2024-11-28 10:21:28', 'deleted_at' => '2024-12-05 07:33:21'],
      ['id' => 62, 'registration_number' => '24242424', 'created_by' => NULL, 'id_faculty' => 2, 'group_id' => NULL, 'firstname_fr' => 'Khlafaoui', 'firstname_ar' => 'Khlafaoui', 'lastname_fr' => 'Elhareth', 'lastname_ar' => 'Elhareth', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2025-01-08', 'state_of_birth' => 'c', 'place_of_birth' => 'c', 'residence' => 'c', 'group' => '2', 'batch' => '2024', 'academicLevel' => NULL, 'specialty' => NULL, 'department' => '5', 'start_date' => '2025-01-08', 'end_date' => '2025-01-22', 'phone' => '0795909138', 'email' => 'elhar2eth0609@gmail.com', 'password' => '$2y$10$vN21vX3hMoEi4JRI99zeuem5V/61tdUhNtrC434i5icbgEW7HOzkq', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2025-01-08 21:32:18', 'updated_at' => '2025-01-08 21:32:18', 'deleted_at' => NULL],
      ['id' => 63, 'registration_number' => '242424256', 'created_by' => NULL, 'id_faculty' => 3, 'group_id' => NULL, 'firstname_fr' => 'Khlafaoui', 'firstname_ar' => 'Khlafaoui', 'lastname_fr' => 'Elhareth', 'lastname_ar' => 'Elhareth', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2025-01-08', 'state_of_birth' => 'c', 'place_of_birth' => 'c', 'residence' => 'c', 'group' => '2', 'batch' => '2024', 'academicLevel' => NULL, 'specialty' => NULL, 'department' => '8', 'start_date' => '2025-01-08', 'end_date' => '2025-01-22', 'phone' => '0795903138', 'email' => 'elhar2et3h0609@gmail.com', 'password' => '$2y$10$h9hFD9d9NDiXlYHCGm6BHe.uoMjHN05KId0z/SfbNEpNpSnCUUtI6', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2025-01-08 21:34:34', 'updated_at' => '2025-01-08 21:34:34', 'deleted_at' => NULL],
      ['id' => 64, 'registration_number' => '24242424343', 'created_by' => NULL, 'id_faculty' => 2, 'group_id' => NULL, 'firstname_fr' => 'Khlafaoui', 'firstname_ar' => 'Khlafaoui', 'lastname_fr' => 'Elhareth', 'lastname_ar' => 'Elhareth', 'username' => NULL, 'status' => 1, 'photo' => NULL, 'gender' => 1, 'birthday' => '2025-01-08', 'state_of_birth' => 'c', 'place_of_birth' => 'c', 'residence' => 'c', 'group' => '2', 'batch' => '2024', 'academicLevel' => NULL, 'specialty' => NULL, 'department' => 'قسم البيولوجيا', 'start_date' => '2025-01-08', 'end_date' => '2025-01-16', 'phone' => '0495903138', 'email' => 'elhar2et33h0609@gmail.com', 'password' => '$2y$10$ubarOjTrLWwc3Kkw2Tt1yeAKHu9rtrq2gC9xAQomBbrCy1bYTfyoC', 'moyenFinal' => 17, 'project_stage' => 1, 'created_at' => '2025-01-08 21:35:51', 'updated_at' => '2025-01-08 21:35:51', 'deleted_at' => NULL],
    ];
    Student::insert($students);
  }
}
