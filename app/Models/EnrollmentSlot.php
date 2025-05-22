<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'slot_status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}