<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $departments = [
      ['name_ar' => 'الري و الهندسة المدنية', 'name_fr' => 'Hydraulique et Génie Civil', 'id_faculty' => 1],
      ['name_ar' => 'الهندسة الكهربائية', 'name_fr' => 'Génie Électrique', 'id_faculty' => 1],
      ['name_ar' => 'هندسة الطرائق و البتروكيمياء', 'name_fr' => 'Génie des Procédés et Pétrochimie', 'id_faculty' => 1],
      ['name_ar' => 'هندسة ميكانيكية', 'name_fr' => 'Génie Mécanique', 'id_faculty' => 1],
      ['name_ar' => 'قسم البيولوجيا', 'name_fr' => 'Département de Biologie', 'id_faculty' => 2],
      ['name_ar' => 'قسم الفلاحة', 'name_fr' => 'Département d\'Agriculture', 'id_faculty' => 2],
      ['name_ar' => 'الترجمة', 'name_fr' => 'Traduction', 'id_faculty' => 3],
      ['name_ar' => 'اللغة إنجليزية', 'name_fr' => 'Langue Anglaise', 'id_faculty' => 3],
      ['name_ar' => 'اللغة الفرنسية', 'name_fr' => 'Langue Française', 'id_faculty' => 3],
      ['name_ar' => 'اللغة و الأدب العربي', 'name_fr' => 'Langue et Littérature Arabe', 'id_faculty' => 3],
      ['name_ar' => 'الإعلام و الاتصال', 'name_fr' => 'Information et Communication', 'id_faculty' => 4],
      ['name_ar' => 'التاريخ', 'name_fr' => 'Histoire', 'id_faculty' => 4],
      ['name_ar' => 'علم النفس', 'name_fr' => 'Psychologie', 'id_faculty' => 4],
      ['name_ar' => 'علم النفس و علوم التربية', 'name_fr' => 'Psychologie et Sciences de l\'Éducation', 'id_faculty' => 4],
      ['name_ar' => 'علوم إجتماعية', 'name_fr' => 'Sciences Sociales', 'id_faculty' => 4],
      ['name_ar' => 'علوم إنسانية', 'name_fr' => 'Sciences Humaines', 'id_faculty' => 4],
      ['name_ar' => 'العلوم الاقتصادية', 'name_fr' => 'Sciences Économiques', 'id_faculty' => 5],
      ['name_ar' => 'العلوم التجارية', 'name_fr' => 'Sciences Commerciales', 'id_faculty' => 5],
      ['name_ar' => 'العلوم المالية و المحاسبية', 'name_fr' => 'Sciences Financières et Comptables', 'id_faculty' => 5],
      ['name_ar' => 'علوم التسيير', 'name_fr' => 'Sciences de Gestion', 'id_faculty' => 5],
      ['name_ar' => 'العلوم السياسية', 'name_fr' => 'Sciences Politiques', 'id_faculty' => 6],
      ['name_ar' => 'حقوق', 'name_fr' => 'Droit', 'id_faculty' => 6],
      ['name_ar' => 'إعلام آلي', 'name_fr' => 'Informatique', 'id_faculty' => 7],
      ['name_ar' => 'رياضيات', 'name_fr' => 'Mathématiques', 'id_faculty' => 7],
      ['name_ar' => 'علوم المادة', 'name_fr' => 'Sciences de la Matière', 'id_faculty' => 7],
      ['name_ar' => 'فيزياء', 'name_fr' => 'Physique', 'id_faculty' => 7],
      ['name_ar' => 'كيمياء', 'name_fr' => 'Chimie', 'id_faculty' => 7],
      ['name_ar' => 'قسم أصول الدين', 'name_fr' => 'Département des Fondements de la Religion', 'id_faculty' => 8],
      ['name_ar' => 'قسم الحضارة الإسلامية', 'name_fr' => 'Département de la Civilisation Islamique', 'id_faculty' => 8],
      ['name_ar' => 'قسم الشريعة', 'name_fr' => 'Département de la Charia', 'id_faculty' => 8],
    ];
    foreach ($departments as $department){
      Departement::create($department);
    }
  }
}
