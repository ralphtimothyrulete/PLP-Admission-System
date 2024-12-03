<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'suffix', 'age', 'sex', 
        'contact_number', 'religion', 'sports', 'residency_status', 
        'district', 'barangay', 'non_pasig_resident', 'address', 'email', 
        'talents', 'strand', 'salary'
    ];

    public function parentsGuardians()
    {
        return $this->hasMany(ParentGuardian::class);
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
