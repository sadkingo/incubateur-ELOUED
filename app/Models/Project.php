<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Project extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'commission_id' ,
        'name',
        'description',
        'video',
        'bmc',
        'start_date',
        'end_date',
        'academic_year',
        'code',
        'password'
    ];


    public function studentGroups() {
      return $this->hasMany(StudentGroup::class);
    }

    public function supervisingGroups() {
      return $this->hasMany(SupervisingTeacherGroups::class);
    }

    public function students() {
        // return $this->hasManyThrough(Student::class, StudentGroup::class, 'project_id', 'id', 'id', 'student_id');
        return $this->belongsToMany(Student::class, StudentGroup::class, 'project_id', 'student_id') ; // Include additional pivot table columns if needed

    }

    public function faculty() {
      return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function commission() {
        return $this->belongsTo(Commission::class, 'commission_id');
    }

    public function supervisingTeachers() {
        return $this->hasManyThrough(
            SupervisingTeacher::class,
            SupervisingTeacherProject::class,
            'id_project', // Foreign key on SupervisingTeacherProject table
            'id', // Foreign key on SupervisingTeacher table
            'id', // Local key on Project table
            'id_supervisor' // Local key on SupervisingTeacherProject table
        );
    }

    public function supervisingTeacherProjects() {
        return $this->hasMany(SupervisingTeacherProject::class, 'id_project', 'id');
    }

    public function getAuthIdentifierName()
    {
        return 'code'; // This should match the field you are using for authentication
      }
      
      public function getAuthIdentifier()
      {
      return 'code'; // This should match the field you are using for authentication
        // return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function setPasswordAttribute($password) {
      $this->attributes['password'] = Hash::make($password);
    }
    // Optionally, you can add methods for password verification if needed
    public function getAuthPassword() {
        return $this->password; // Ensure you have this method for password verification
    }

    public function statusAdministrative() {
      return $this->hasMany(AdministrativeFiles::class);
    }

}
