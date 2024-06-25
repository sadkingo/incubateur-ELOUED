<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentGroup extends Authenticatable
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
        'registration_number',
        'academicLevel',
        'specialty',
        'faculty',
        'department',
        'photo',        
    ];
}
