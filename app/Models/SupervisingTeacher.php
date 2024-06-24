<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupervisingTeacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname_ar',
        'firstname_fr',
        'lastname_ar',
        'lastname_fr',
        'gender',
        'grade',
        'phone',
        'email',
        'photo',
        'speciality',
        'faculty',
        'departement',
        'grade',
        'id_student',
    ];

    public function supervisingTeacherProjects() {
        return $this->hasMany(SupervisingTeacherProject::class, 'id_supervisor', 'id');
    }
}
