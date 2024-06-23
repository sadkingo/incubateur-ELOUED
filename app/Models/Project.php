<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'video',
        'bmc',
        'id_commission' ,
        'start_date',
        'end_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'id_commission');
    }

    public function supervisingTeachers()
    {
        return $this->hasManyThrough(
            SupervisingTeacher::class,
            SupervisingTeacherProject::class,
            'id_project', // Foreign key on SupervisingTeacherProject table
            'id', // Foreign key on SupervisingTeacher table
            'id', // Local key on Project table
            'id_supervisor' // Local key on SupervisingTeacherProject table
        );
    }
 
}
