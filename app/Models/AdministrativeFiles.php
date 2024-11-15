<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeFiles extends Model
{
    use HasFactory;


    protected $fillable = [
        'registration_certificate',
        'identification_card',
        'photo',
        'status',
        'student_id',
        'project_id',
    ];


    public function student() {
        return $this->belongsTo(Student::class);
    }
}
