<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['id' => 1, 'name' => 'المواضبة على الحضور', 'coef' => 2, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 2, 'name' => 'كمية المشاركة', 'coef' => 1, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 3, 'name' => 'جودة المشاركة', 'coef' => 2, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 4, 'name' => 'روح المبادرة', 'coef' => 1, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 5, 'name' => 'الحضور الذهني', 'coef' => 2, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 6, 'name' => 'القيم الأخلاقية', 'coef' => 2, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 7, 'name' => 'الهندام', 'coef' => 1, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 8, 'name' => 'العلاقة الإنسانية و التفاعل مع الفريق', 'coef' => 1, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 9, 'name' => 'اعمال المعارف التطبيقية و قدرة العمل', 'coef' => 6, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
            ['id' => 10, 'name' => 'اختبار نهاية التربص', 'coef' => 2, 'created_at' => '2024-05-06 15:55:48', 'updated_at' => '2024-05-06 15:55:48',],
        ];
        Subject::insert($subjects);
    }
}
