<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'result',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}