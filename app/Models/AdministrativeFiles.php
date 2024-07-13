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
        'student_group_id',
    ];
}
