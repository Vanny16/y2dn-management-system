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

    public function delete_document($id)
    {
        // Find the document by ID
        $document = StudentDocuments::find($id);

        // Check if the document exists
        if ($document) {
            // Find the associated StudentEnrolled record
            $enrolledStudent = StudentEnrolled::where('student_id', $document->student_id)->first();

            // Check if the associated StudentEnrolled record exists
            if ($enrolledStudent) {
                // Delete the associated StudentEnrolled record
                $enrolledStudent->delete();
            }

            // Delete the document
            $document->delete();

            // Redirect back with a success message
            return redirect('/student_documents')->with('success', 'Document deleted successfully!');
        } else {
            // Redirect back with an error message
            return redirect('/student_documents')->with('error', 'Document not found!');
        }
    }
}
