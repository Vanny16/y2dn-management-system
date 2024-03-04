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


    public function updateStudentDocuments(Request $request, $id)
    {
        // Validate other fields as per your requirement

        // Check if at least one file is attached
        if (!$request->hasAny(['birth_certificate', 'form_137', 'transcript_generation', 'good_moral'])) {
            return redirect()->back()->with('warning', 'No attached files.');
        }

        // Validate and store image files
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        foreach (['birth_certificate', 'form_137', 'transcript_generation', 'good_moral'] as $document) {
            if ($request->hasFile($document)) {
                $file = $request->file($document);
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->with('error', 'Only JPEG, JPG, and PNG images are allowed.');
                }

                // Generate a unique filename
                $filename = $document . '_' . $id . '.' . $extension;

                // Store the image in the server's filesystem
                $file->storeAs('student_documents', $filename, 'public');

                // Save the file path in the database
                $data[$document] = 'student_documents/' . $filename;
            }
        }

        // Update the student documents
        $studentDocument = StudentDocuments::find($id);
        $studentDocument->update($data);

        return redirect()->back()->with('success', 'Student documents updated successfully.');
    }

    public function downloadStudentDocument($id, $type)
{
    // Find the student document
    $studentDocument = StudentDocuments::find($id);

    // Check if the document type exists
    if (!$studentDocument || !$studentDocument->$type) {
        abort(404);
    }

    // Get the file path from the database
    $filePath = storage_path('app/public/' . $studentDocument->$type);

    // Check if the file exists
    if (!file_exists($filePath)) {
        abort(404);
    }

    // Set the appropriate content type
    $contentType = mime_content_type($filePath);

    // Set the headers for file download
    $headers = [
        'Content-Type' => $contentType,
        'Content-Disposition' => 'attachment;filename="' . basename($filePath) . '"',
    ];

    // Return the file as a response
    return response()->download($filePath, null, $headers);
}


}
