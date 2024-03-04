<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocuments extends Model
{
    protected $table = 'student_documents';

    protected $fillable = [
        'student_id',
        'last_name',
        'first_name',
        'middle_name',
        'birth_certificate',
        'form_137',
        'transcript_generation',
        'good_moral',
    ];

    public function enrolled()
    {
        return $this->belongsTo(StudentEnrolled::class, 'student_id', 'student_id');
    }

    
}