<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_fr',
    ];
    public function departments()
    {
        return $this->hasMany(Departement::class);
    }

    public function manager() {
        return $this->hasOne(Manager::class);
    }

    public function studentInnovations()
    {
        return $this->hasManyThrough(Student::class, Departement::class);
    }
}
