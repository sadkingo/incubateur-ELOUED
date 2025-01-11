<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Seeder;

class CommissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $commissions = [
      ['id' => 1, "name_ar" => 'لجنة المشاريع المبتكرة', "name_fr" => 'Comité des Projets Innovants', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-07-16 16:13:28', "updated_at" => '2024-07-16 16:13:28', "deleted_at" => NULL],
      ['id' => 2, "name_ar" => 'اللجنة الخاصة بتقييم أفكار  بالمنصات والتطبيقات', "name_fr" => 'com2', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-07-17 18:44:08', "updated_at" => '2024-07-17 18:44:08', "deleted_at" => NULL],
      ['id' => 3, "name_ar" => 'لجنة تقييم براءات الاختراع', "name_fr" => 'com 3', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-07-24 06:24:09', "updated_at" => '2024-07-24 06:24:09', "deleted_at" => NULL],
      ['id' => 4, "name_ar" => 'elhareth csdcs', "name_fr" => 'elhareth csdcs', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-11-02 14:47:27', "updated_at" => '2024-11-02 14:47:33', "deleted_at" => '2024-11-02 14:47:33'],
      ['id' => 5, "name_ar" => 'Khlafaoui Elhareth', "name_fr" => 'Khlafaoui Elhareth', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-11-07 15:17:18', "updated_at" => '2024-11-07 15:17:18', "deleted_at" => NULL],
      ['id' => 6, "name_ar" => 'Khlafaoui Elhareth', "name_fr" => 'Khlafaoui Elhareth', "photo" => NULL, "status" => 1, "id_project" => NULL, "created_at" => '2024-11-07 15:22:04', "updated_at" => '2024-11-07 15:22:09', "deleted_at" => '2024-11-07 15:22:09'],
    ];
    Commission::insert($commissions);
  }
}
