<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'file_name',
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }
}
