<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentGroup extends Model {

    use HasFactory;

    protected $fillable = [
        'student_id',
        'project_id',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the project associated with this group entry.
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }

}
