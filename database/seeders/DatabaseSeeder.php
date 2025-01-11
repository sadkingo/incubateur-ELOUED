<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $staticSeeders = [
      AdminTableSeeder::class,
      StudentTableSeeder::class,
    ];
    $developmentSeeders = [];

    if (App::environment('local')) {
      $developmentSeeders = [
        AdministrativeFileTableSeeder::class,
        AttendenceTableSeeder::class,
        DepartementTableSeeder::class,
        CommissionTableSeeder::class,
        SettingTableSeeder::class,
        FacultyTableSeeder::class,
        ManagerTableSeeder::class,
        SubjectTableSeeder::class,
        SupervisingTeacherTableSeeder::class,
        CertificateTableSeeder::class,
        ProjectTableSeeder::class,
        TeacherTableSeeder::class,
        SupervisingTeacherProjectTableSeeder::class,
//        sql data given does not much migration
//        StudentGroupsTableSeeder::class,
      ];
    }

    $this->call([
      ...$staticSeeders,
      ...$developmentSeeders,
    ]);
  }
}
