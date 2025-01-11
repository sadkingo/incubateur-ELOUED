<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultyTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faculties = [
      ['name_ar' => 'كلية التكنولوجيا', 'name_fr' => 'Faculté de Technologie'],
      ['name_ar' => 'كلية علوم الطبيعة و الحياة', 'name_fr' => 'Faculté des Sciences de la Nature et de la Vie'],
      ['name_ar' => 'كلية الآداب و اللغات', 'name_fr' => 'Faculté des Lettres et des Langues'],
      ['name_ar' => 'كلية العلوم الاجتماعية و الانسانية', 'name_fr' => 'Faculté des Sciences Sociales et Humaines'],
      ['name_ar' => 'كلية العلوم الاقتصادية و التجارية و علوم التسيير', 'name_fr' => 'Faculté des Sciences Économiques, Commerciales et des Sciences de Gestion'],
      ['name_ar' => 'كلية الحقوق و العلوم السياسية', 'name_fr' => 'Faculté de Droit et des Sciences Politiques'],
      ['name_ar' => 'كلية العلوم الدقيقة', 'name_fr' => 'Faculté des Sciences Exactes'],
      ['name_ar' => 'معهد العلوم الاسلامية', 'name_fr' => 'Institut des Sciences Islamiques'],
    ];

    foreach ($faculties as $faculty) {
      Faculty::create($faculty);
    }
  }
}
