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

    public function enrolled_students()
    {
        // Fetch data from the database
        $enrolledStudents = StudentEnrolled::all();

        // Pass data to the view
        return view('management.enrolled_students', ['enrolledStudents' => $enrolledStudents]);
    }

    public function delete_enrollee($id)
    {
        // Find the enrollee by ID
        $enrollee = StudentEnrolled::find($id);

        // Check if the enrollee exists
        if ($enrollee) {
            // Delete the enrollee
            $enrollee->delete();

            // Redirect back with a success message
            return redirect('/enrolled_students')->with('success', 'Student deleted successfully!');
        } else {
            // Redirect back with an error message
            return redirect('/enrolled_students')->with('error', 'Student not found!');
        }
    }

    public function enroll_student()
    {
        return view('management.enroll_student');
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
            'dob' => 'required',
            'department' => 'required',
            'program' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            // Add other validation rules as needed
        ]);

        // Create a new instance of the StudentEnrolled model
        $enrollee = new StudentEnrolled;

        // Set the attributes with the validated data
        $enrollee->student_id = $request->input('student_id');
        $enrollee->last_name = $request->input('last_name');
        $enrollee->first_name = $request->input('first_name');
        $enrollee->middle_name = $request->input('middle_name');
        $enrollee->gender = $request->input('gender');
        $enrollee->mobile_number = $request->input('mobile_number');
        $enrollee->email = $request->input('email');
        $enrollee->address = $request->input('address');
        $enrollee->dob = $request->input('dob');
        $enrollee->department = $request->input('department');
        $enrollee->program = $request->input('program');
        // Set other attributes as needed

        // Save the enrollee to the database
        $enrollee->save();

        // Redirect to the dashboard
        return redirect('/enrolled_students')->with('success', 'Student enrolled successfully!');
    }

    public function edit($id)
    {
        //Find the enrolled student by ID
        $enrolledStudent = StudentEnrolled::find($id);

        // Check if the enrolled student exists
        if ($enrolledStudent) {
            // Pass the enrolled student data to the view
            return view('management.enrolled_student_update', ['enrolledStudent' => $enrolledStudent]);
        }
    }
    public function update_enrollee(Request $request, $id)
    {
        // Find the enrolled student by ID
        $enrolledStudent = StudentEnrolled::find($id);

        // Validate the request data
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required',
            'email' => ['required', 'email', Rule::unique('student_enrolled')->ignore($enrolledStudent->id)],
            'address' => 'required',
            'dob' => 'required',
            'department' => 'required',
            'program' => 'required',
            // Add other validation rules as needed
        ]);

        // Update the enrolled student with the validated data
        $enrolledStudent->last_name = $request->input('last_name');
        $enrolledStudent->first_name = $request->input('first_name');
        $enrolledStudent->middle_name = $request->input('middle_name');
        $enrolledStudent->gender = $request->input('gender');
        $enrolledStudent->mobile_number = $request->input('mobile_number');
        $enrolledStudent->email = $request->input('email');
        $enrolledStudent->address = $request->input('address');
        $enrolledStudent->dob = $request->input('dob');
        $enrolledStudent->department = $request->input('department');
        $enrolledStudent->program = $request->input('program');
        // Update other attributes as needed

        // Save the updated enrollee to the database
        $enrolledStudent->save();

        // Redirect to the dashboard with a success message
        return redirect('/enrolled_students')->with('success', 'Student updated successfully!');
    }


}
