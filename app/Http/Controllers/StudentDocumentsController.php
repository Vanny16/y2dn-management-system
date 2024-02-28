<?php

namespace App\Http\Controllers;

use App\Models\StudentDocuments;
use Illuminate\Http\Request;

class StudentDocumentsController extends Controller
{
    protected $table = 'studentDocuments';

    public function student_documents()
    {
        
        // Fetch data from the database
        $studentDocuments = StudentDocuments::all();

        // Pass data to the view
        return view('management.student_documents', ['studentDocuments' => $studentDocuments]);
    }
}
