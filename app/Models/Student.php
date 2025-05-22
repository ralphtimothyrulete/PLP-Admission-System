<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'last_name', 
        'first_name', 
        'middle_name', 
        'suffix', 
        'age', 
        'sex', 
        'contact_number', 
        'religion', 
        'sports', 
        'residency_status', 
        'district', 
        'barangay', 
        'non_pasig_resident', 
        'address', 
        'email', 
        'talents', 
        'strand', 
        'salary',
        'step',
    ];

    public function parentsGuardians()
    {
        return $this->hasMany(ParentGuardian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
