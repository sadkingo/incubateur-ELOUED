<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_fr',
        'id_faculty'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'id_faculty');
    }

    public function studentInnovations()
    {
        return $this->hasMany(Student::class);
    }
}
