<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupervisingTeacher extends Model
{
    use HasFactory, SoftDeletes;

   // protected $table = 'supervising_teachers';
    protected $fillable = [
//        'faculty_id',
        'departement_id',
        'firstname_ar',
        'firstname_fr',
        'lastname_ar',
        'lastname_fr',
        'gender',
        'grade',
        'phone',
        'email',
        'speciality',
    ];

    public function getNameArAttribute(){
      return ucwords("{$this->firstname_ar} {$this->lastname_ar}");
    }

    public function getNameFrAttribute(){
      return ucwords("{$this->firstname_fr} {$this->lastname_fr}");
    }

    public function supervisingTeacherProjects() {
        return $this->hasMany(SupervisingTeacherProject::class, 'id_supervisor', 'id');
    }

    // public function faculty() {
    //     return $this->belongsTo(Faculty::class, 'faculty_id');
    // }

    public function departement() {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
}
