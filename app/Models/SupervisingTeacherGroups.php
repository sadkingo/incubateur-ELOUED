<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisingTeacherGroups extends Model
{
    use HasFactory;
    protected $fillable = [
        'supervising_teacher_id',
        'project_id',
        'role',
    ];
}
