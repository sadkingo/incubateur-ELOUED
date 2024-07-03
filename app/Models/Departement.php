<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    
    public function studentInnovations()
    {
        return $this->hasMany(Student::class);
    }
}
