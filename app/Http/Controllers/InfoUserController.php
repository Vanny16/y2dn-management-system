<?php

namespace App\Http\Controllers;

use App\Models\StudentEnrolled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use DateTime;

class InfoUserController extends Controller
{
    protected $table = 'student_enrolled';

    public function enroll_student()
    {
        return view('laravel-examples.enroll_student');
    }

    public function save_enrollee(Request $request)
    {
        // Validate the request data
        $request->validate([
            'student_id' => 'required|unique:' . $this->table,
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email|unique:' . $this->table,
            'address' => 'required',
            'dob' => 'required|date_format:m-d-Y',
            'department' => 'required',
            'program' => 'required',
            // Add other validation rules as needed
        ]);

      // Parse and format the date of birth
        $dob = DateTime::createFromFormat('m-d-Y', $request->dob)->format('Y-m-d');

        // Save to the database
        $enrollee = new StudentEnrolled($request->all());
        $enrollee->dob = $dob; // Set the formatted date of birth
        $enrollee->save();

        // Redirect to the dashboard
        return redirect('/dashboard')->with('success', 'Student enrolled successfully!');
    }
}
