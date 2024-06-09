<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_fr',
        'photo',
        'status',
    ];
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'id_commission');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'id_commission');
    }

    
}
