<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'student_id',
        'path',
        'source',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
