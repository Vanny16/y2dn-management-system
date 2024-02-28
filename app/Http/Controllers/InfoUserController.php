<?php

namespace App\Http\Controllers;

use App\Models\StudentEnrolled;
use App\Models\UsersModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use DateTime;
use DB;
use App\Models\StudentDocuments;

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
            // Find and delete the corresponding record in StudentDocuments table
            $studentDocuments = StudentDocuments::where('student_id', $enrollee->student_id)->first();
            if ($studentDocuments) {
                $studentDocuments->delete();
            }

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

        // Create a corresponding student documents record
        $studentDocuments = new StudentDocuments([
            'student_id' => $enrollee->student_id,
            'last_name' => $enrollee->last_name,
            'first_name' => $enrollee->first_name,
            'middle_name' => $enrollee->middle_name,
        ]);

        $studentDocuments->save();

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

        // Update the corresponding record in the StudentDocuments table
        $studentDocuments = StudentDocuments::where('student_id', $enrolledStudent->student_id)->first();
        if ($studentDocuments) {
            $studentDocuments->last_name = $enrolledStudent->last_name;
            $studentDocuments->first_name = $enrolledStudent->first_name;
            $studentDocuments->middle_name = $enrolledStudent->middle_name;
            // Update other fields as needed
            $studentDocuments->save();
        }

        // Redirect to the dashboard with a success message
        return redirect('/enrolled_students')->with('success', 'Student updated successfully!');
    }

    public function add_staff(Request $request)
    {

        // dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            // 'address' => 'required',
            'password' => 'required|min:8',
            'user_role' => 'required',

        ]);
        $validatedData['password'] = Hash::make($request->input('password'));
        $validatedData['created_at'] = Carbon::parse('2022-01-01 12:00:00');

        // Create a new user record
        DB::table('users')->insert($validatedData);

        return redirect('/user-management')->with('success', 'Staff Added successfully!');
    }

    public function user_management()
    {
        // Fetch data from the database
        // $users_list = UsersModel::all();
        $users_list = DB::table('users')
            ->join('user_roles', 'user_roles.id', '=', 'users.user_role')
            ->get();

        $roles_list = DB::table('user_roles')
            ->get();


        // Pass data to the view
        return view('management.user-management', compact('users_list', 'roles_list'));
    }


}
