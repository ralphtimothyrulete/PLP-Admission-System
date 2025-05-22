<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'school_type', 'public_school', 'other_school', 'private_school'
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
