<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\SupervisingTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupervisingTeachersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $supervisingTeachers = [
      ['id_student' => 55, 'faculty_id' => 1,'faculty' => 1, 'departement_id' => 1,'departement' => 1, 'phone' => '0554525521', 'email' => 'Benazouzmourtada@yahou.fr', 'firstname_fr' => 'Mourtada', 'firstname_ar' => 'مرتضى', 'lastname_fr' => 'Benazouz', 'lastname_ar' => 'بن عزوز', 'gender' => 1, 'photo' => 'IA', 'speciality' => 'Class A', 'grade' => 1, 'role' => 1 ],
      ['id_student' => 56, 'faculty_id' => 1,'faculty' => 1, 'departement_id' => 23,'departement' => 23, 'phone' => '0664890184', 'email' => 'asilammar48@gmail.com', 'firstname_fr' => 'ammr', 'firstname_ar' => 'عمار', 'lastname_fr' => 'djaidja', 'lastname_ar' => 'جعيجع', 'gender' => 1, 'photo' => 'مالية', 'speciality' => 'محاضر ب', 'grade' => 1, 'role' => 1 ],
      ['id_student' => 57, 'faculty_id' => 1,'faculty' => 1, 'departement_id' => 1,'departement' => 1, 'phone' => '0668022334', 'email' => 'drfouadferhat@gmail.com', 'firstname_fr' => 'fff', 'firstname_ar' => 'للللل', 'lastname_fr' => 'fff', 'lastname_ar' => 'بببببب', 'gender' => 1, 'photo' => 'fff', 'speciality' => ',cb', 'grade' => 1, 'role' => 1 ],
      ['id_student' => 58, 'faculty_id' => 2,'faculty' => 2, 'departement_id' => 10,'departement' => 10, 'phone' => '0795909828', 'email' => 'elhareth079@gmail.com', 'firstname_fr' => 'خلفاوي', 'firstname_ar' => 'خلفاوي', 'lastname_fr' => 'الحارث', 'lastname_ar' => 'الحارث', 'gender' => 1, 'photo' => 'hhh', 'speciality' => '23', 'grade' => 1, 'role' => 1 ],
      ['id_student' => 59, 'faculty_id' => 7,'faculty' => 7, 'departement_id' => 27,'departement' => 27, 'phone' => '079455909128', 'email' => 'elhareth0ss609@gmail.com', 'firstname_fr' => 'Khlafaoui', 'firstname_ar' => 'خخخ', 'lastname_fr' => 'Elhareth', 'lastname_ar' => 'تتت', 'gender' => 1, 'photo' => 'hhh', 'speciality' => '23', 'grade' => 1, 'role' => 1 ],
    ];
    SupervisingTeacher::insert($supervisingTeachers);
  }
}
