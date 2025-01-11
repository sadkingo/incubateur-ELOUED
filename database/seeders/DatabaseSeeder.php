<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminTableSeeder;
use Database\Seeders\StudentTableSeeder;
use Database\Seeders\SubjectTableSeeder;
use Database\Seeders\TeacherTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
      StudentsTableSeeder::class,
    ];
    $developmentSeeders = [];

    if (App::environment('local')) {
      $developmentSeeders = [
        AdministrativeFilesTableSeeder::class,
        AttendencesTableSeeder::class,
        DepartementsTableSeeder::class,
        CommissionsTableSeeder::class,
        SettingsTableSeeder::class,
        FacultiesTableSeeder::class,
        ManagersTableSeeder::class,
        SubjectsTableSeeder::class,
        SupervisingTeachersTableSeeder::class,
        CertificatesTableSeeder::class,
        ProjectsTableSeeder::class,
        TeacherTableSeeder::class,
        SupervisingTeacherProjectsTableSeeder::class,
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
