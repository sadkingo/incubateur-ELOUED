<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::insert(
          ['id' => 1, 'commission_id' => 2, 'phone' => '0656565656', 'email' => 'adm5in@gmail.com', 'password' => '$2y$10$XleBZfNLFsosI32FR6T.AeThKQpDlwwBLNkAFo5v1JjrmsA3MMEWy', 'firstname_fr' => 'vomm', 'firstname_ar' => 'لجنة', 'lastname_fr' => 'vvvv', 'lastname_ar' => 'تجربة', 'birthday' => '1992-12-12', 'gender' => 1, 'grade' => 'م ا', 'address' => 'كلية التكنولوجيا', 'status' => 1, 'photo' => NULL ],
          ['id' => 2, 'commission_id' => 1, 'phone' => '0795909128', 'email' => 'teacher@gmail.com', 'password' => '$2y$10$Rbf82Gs5BqNlcsrgfIMTe.C77iT.98LrRTbMCa0Qi2CuH.1UE9epC', 'firstname_fr' => 'elhareth', 'firstname_ar' => 'elhareth', 'lastname_fr' => 'csdcs', 'lastname_ar' => 'csdcs', 'birthday' => '2024-10-17', 'gender' => 1, 'grade' => 'BT 4 N 3', 'address' => "alger", 'status' => 1, 'photo' => NULL, ],
          ['id' => 3, 'commission_id' => 1, 'phone' => '0795909134', 'email' => 'elhareth0609@gmail.com', 'password' => '$2y$10$7sRb7jRCM/Rl0broEryCeexrbVyFQhtVnk9O0Xji7MSD5IR7UmU0i', 'firstname_fr' => 'خلفاوي', 'firstname_ar' => 'خلفاوي', 'lastname_fr' => 'الحارث', 'lastname_ar' => 'الحارث', 'birthday' => '2024-11-07', 'gender' => 1, 'grade' => '23', 'address' => 'Eloued', 'status' => 1, 'photo' => NULL, ],
          ['id' => 4, 'commission_id' => 2, 'phone' => '0795949128', 'email' => 'elhareth0609ds@gmail.com', 'password' => '$2y$10$9c/oJDU3CBd5K5T5oT9w7ujJKXYYwspn4xbn9AGlULkQTQnq5nxc.', 'firstname_fr' => 'خلفاوي', 'firstname_ar' => 'خلفاوي', 'lastname_fr' => 'الحارث', 'lastname_ar' => 'الحارث', 'birthday' => '2024-11-07', 'gender' => 1, 'grade' => '23', 'address' => 'Eloued', 'status' => 1, 'photo' => NULL, ],);
    }
}
