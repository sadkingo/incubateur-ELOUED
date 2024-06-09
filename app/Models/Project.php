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
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'id_commission');
    }
}
