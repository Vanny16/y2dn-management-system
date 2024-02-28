<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrolled extends Model
{
    use HasFactory;

    protected $table = 'student_enrolled';

    protected $fillable = [
        'student_id',
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'mobile_number',
        'email',
        'address',
        'dob',
        'department',
        'program',
    ];

    public function documents()
    {
        return $this->hasOne(StudentDocuments::class, 'student_id', 'student_id');
    }
}
