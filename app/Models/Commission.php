<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_fr',
        'photo',
        'status',
    ];
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'id_commission');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'id_commission');
    }


    public function studentsFromProjects()
    {
        return $this->hasManyThrough(Student::class, Project::class, 'id_commission', 'id', 'id', 'id_student');
    }

    public function studentsFromGroups()
    {
        $studentIds = $this->projects->pluck('id_student')->toArray();
        return Student::whereIn('id', function($query) use ($studentIds) {
            $query->select('id_student')
                  ->from('student_groups')
                  ->whereIn('id_student', $studentIds);
        })->get();
    }


    public function students()
    {
        return $this->studentsFromProjects->merge($this->studentsFromGroups())->unique('id');
    }
    
}
