<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Attendence;
use App\Models\Certificate;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname_ar',
        'firstname_fr',
        'lastname_ar',
        'lastname_fr',
        'gender',
        'birthday',
        'state_of_birth',
        'place_of_birth',

        'photo',
        'status',

        'group',
        'registration_number',
        'residence',
        'batch',
        'academicLevel',
        'specialty',
        'faculty',
        'id_faculty',
        'department',
        'id_department',
        'start_date',
        'end_date',

        'phone',
        'email',
        'password',

        'moyenFinal',
        'project_stage',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function setPasswordAttribute($value): void{
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullNameArAttribute() {
        return "{$this->firstname_ar} {$this->lastname_ar}";
    }

    public function getFullNameFrAttribute() {
        return "{$this->firstname_fr} {$this->lastname_fr}";
    }

    public function getNameAttribute(){
        return ucwords("{$this->firstname_ar} {$this->lastname_ar}");
    }

    public function getTotalCoefAttribute(){
        $totalCoef = 0;
        foreach ($this->tests as $test) {
            $totalCoef = $totalCoef + $test->subject->coef;
        }
        return $totalCoef;
    }

    public function getNoteAttribute(){
        $totalNote = 0;
        foreach ($this->tests as $test) {
            $totalNote = $totalNote + $test->subject->coef * $test->rate;
        }
        return $totalNote;
    }

    public function getMoyenAttribute(){
        $moyen  = 0;
        foreach ($this->tests as $test) {
            $moyen = $moyen + $test->result;
        }
        return  $this->total_coef > 0 ? $moyen / $this->total_coef : null;
    }

    public function studentGroups() {
      return $this->hasMany(StudentGroup::class);
    }

    public function projects() {
        return $this->hasManyThrough(Project::class, StudentGroup::class, 'student_id', 'id', 'id', 'project_id');
    }

    public function tests(){
        return $this->hasMany(Test::class);
    }

    public function certificate(){
        return $this->hasMany(Certificate::class);
    }
    
    public function attendences(): HasMany{
        return $this->hasMany(Attendence::class);
    }
    public function evaluations(){
        return $this->hasOne(Evaluation::class);
    }

    public function notes(){
        return $this->hasOne(Note::class);
    }

    // public function projects(){
    //     return $this->hasMany(Project::class);
    // }

    public function department(){
        return $this->belongsTo(Departement::class);
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class,'id_faculty');
    }

    public function project(){
        return $this->hasOne(Project::class, 'id_student');
    }
    public function projectss()
    {
        return $this->hasMany(Project::class, 'id_student');
    }
    public function studentGroup(){
        return $this->hasOne(StudentGroup::class, 'id_student');
    }
    // public function studentGroups(){
    //     return $this->hasMany(StudentGroup::class, 'id_student');
    // }
    public function certificates(){
        return $this->hasMany(Certificate::class, 'student_id');
    }

    public function photoUrl() {
      $photo = $this->photo;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/photos/users/' . $photo);
      }
  }

  public function photoPath() {
    $photo = $this->photo;

    if (!empty($photo)) {
        return public_path('assets/img/photos/users/' . $photo);
    } else {
        return null;
    }
  }

}
