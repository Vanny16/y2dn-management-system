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

    public function backup()
    {
        $backup_history = DB::table('backup_logs')
            ->join('users', 'users.id', '=', 'backup_logs.backuped_by')
            ->select('backup_logs.*', 'users.*')
            ->orderBy('backup_logs.backup_datetime', 'desc')

            ->first();

        return view('backup', compact('backup_history'));
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
        $validatedData['created_at'] = now();

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

    public function user_roles()
    {
        // Fetch data from the database
        // $users_list = UsersModel::all();
        $users_list = DB::table('user_roles')
            ->join('user_roles', 'user_roles.id', '=', 'users.user_role')
            ->get();

        $roles_list = DB::table('user_roles')
            ->get();


        // Pass data to the view
        return view('management.user-management', compact('users_list', 'roles_list'));
    }

    public function add_role(request $request)
    {
        $role_name = $request->input('user_role');

        $check_exist = DB::table('user_roles')
            ->where('user_role', $role_name)
            ->first();

        if ($check_exist == null) {
            $save_role = DB::table('user_roles')
                ->insert([
                    'user_role' => $role_name,
                    'status' => 1,
                    'created_at' => now(),


                ]);
            return redirect('user-management')->with('success', 'Role added Successfully!');

        } else {
            return redirect('user-management')->with('error', 'Role already exist!');
        }


    }
    public function user()
    {
        $user = auth()->user();

        // dd($user->id);

        // Assuming $user->id holds the current user's ID.
        $userId = $user->id;

        // $recentChats = DB::table('chats')
        //     ->join('users', function ($join) use ($userId) {
        //         $join->on('users.id', '=', DB::raw("CASE WHEN chats.cht_from = $userId THEN chats.cht_to ELSE chats.cht_from END"));
        //     })
        //     ->where('cht_deleted', 0)
        //     ->where(function ($query) use ($userId) {
        //         $query->where('cht_from', $userId)
        //             ->orWhere('cht_to', $userId);
        //     })
        //     ->select(
        //         DB::raw("CASE WHEN chats.cht_from = $userId THEN chats.cht_to ELSE chats.cht_from END as contact_id"),
        //         'users.first_name',
        //         'users.middle_name',
        //         'users.last_name',
        //         DB::raw('MAX(chats.cht_date) as last_interaction'),
        //         DB::raw('(SELECT cht_message FROM chats as c WHERE (c.cht_from = chats.cht_from AND c.cht_to = chats.cht_to) OR (c.cht_from = chats.cht_to AND c.cht_to = chats.cht_from) ORDER BY chats.cht_date DESC LIMIT 1) as last_message')
        //     )
        //     ->groupBy('contact_id', 'users.first_name', 'users.middle_name', 'users.last_name')
        //     ->orderBy('last_interaction', 'desc')
        //     ->limit(3)
        //     ->get();

        $latestMessageIds = DB::table('chats')
            ->select(DB::raw('GREATEST(cht_from, cht_to) as user1'), DB::raw('LEAST(cht_from, cht_to) as user2'), DB::raw('MAX(cht_id) as last_msg_id'))
            ->where('cht_deleted', 0)
            ->where(function ($q) use ($userId) {
                $q->where('cht_from', $userId)->orWhere('cht_to', $userId);
            })
            ->groupBy(DB::raw('GREATEST(cht_from, cht_to)'), DB::raw('LEAST(cht_from, cht_to)'))
            ->pluck('last_msg_id');

        $recentChats = DB::table('chats as c')
            ->join('users', function ($join) use ($userId) {
                $join->on('users.id', '=', DB::raw("CASE WHEN c.cht_from = $userId THEN c.cht_to ELSE c.cht_from END"));
            })
            ->whereIn('c.cht_id', $latestMessageIds)
            ->select('c.cht_id', 'c.cht_from', 'c.cht_to', 'c.cht_message', 'c.cht_date', 'users.first_name', 'users.middle_name', 'users.last_name')
            ->orderBy('c.cht_date', 'desc')
            ->limit(3)
            ->get();



        return view('profile', [
            'user' => $user,
            'chats' => $recentChats
        ]);
    }


    public function updateProfile(Request $request)
    {

        $user = auth()->user();

        // Validate the request data
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'gender' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'about_me' => 'required',
        ]);

        // Update user profile
        $user->update([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
            'about_me' => $request->input('about_me'),
        ]);

        return redirect('profile')->with('success', 'Profile updated successfully!');
    }


}
