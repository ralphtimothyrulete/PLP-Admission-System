<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGuardian extends Model
{
    use HasFactory;

    protected $table = 'parents_guardians';
    
    protected $fillable = [
        'student_id', 'type', 'last_name', 'first_name', 'middle_name', 'suffix', 'age', 'contact_number', 'email', 'address'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
