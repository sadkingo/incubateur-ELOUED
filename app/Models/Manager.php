<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class Manager extends Authenticatable {
    use HasFactory;

    protected $fillable = [
      'firstname_ar',
      'lastname_ar',
      'phone',
      'email',
      'password',
      'faculty_id',
    ];

    public function getFullNameAttribute() {
        return "{$this->firstname_ar} {$this->lastname_ar}";
    }

    public function getNameAttribute() {
        return ucwords("{$this->firstname_ar} {$this->lastname_ar}");
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function faculty() {
      return $this->belongsTo(Faculty::class);
    }
}
