<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'science_grade', 'mathematics_grade', 
        'english_grade', 'overall_grade', 'first_choice', 'second_choice', 'third_choice', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function firstChoice()
    {
        return $this->belongsTo(Course::class, 'first_choice');
    }

    public function secondChoice()
    {
        return $this->belongsTo(Course::class, 'second_choice');
    }

    public function thirdChoice()
    {
        return $this->belongsTo(Course::class, 'third_choice');
    }
}
