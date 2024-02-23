@extends('layouts.user_type.auth')



@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Student Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form id="enrollForm" action="/save_enrollee" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                    <!-- Error message display -->
                    <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            {{$errors->first()}}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    @if(session('success'))
                    <!-- Success message display -->
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Student ID field -->
                            <div class="form-group">
                                <label for="student-id" class="form-control-label">{{ __('Student ID') }}</label>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        onclick="generateStudentID()">Generate</button>
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="student-id" name="student_id" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- First Column - Last Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last-name" class="form-control-label">{{ __('Last Name') }}</label>
                                <div class="@error('last_name') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Last Name" id="last-name"
                                        name="last_name" required>
                                    @error('last_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Column - First Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first-name" class="form-control-label">{{ __('First Name') }}</label>
                                <div class="@error('first_name') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="First Name" id="first-name"
                                        name="first_name" required>
                                    @error('first_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Third Column - Middle Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle-name" class="form-control-label">{{ __('Middle Name') }}</label>
                                <div class="@error('middle_name') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Middle Name" id="middle-name"
                                        name="middle_name" required>
                                    @error('middle_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- First Column - Gender -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender" class="form-control-label">{{ __('Gender') }}</label>
                                <div class="@error('gender') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Column - Mobile Number -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile-number" class="form-control-label">{{ __('Mobile Number') }}</label>
                                <div class="@error('mobile_number') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="9123456789" maxlength="10"
                                        id="mobile-number" name="mobile_number" required>
                                    @error('mobile_number')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Third Column - Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="user@example.com" id="email"
                                        name="email" required>
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Address and Date of Birth row -->
                    <div class="row">
                        <!-- Address column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">{{ __('Address') }}</label>
                                <div class="@error('address') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Please enter the address"
                                        id="address" name="address" required>
                                    @error('address')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth column with date picker -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob" class="form-control-label">{{ __('Date of Birth') }}</label>
                                <div class="@error('dob') border border-danger rounded-3 @enderror">
                                    <input class="form-control datepicker" type="date"
                                        placeholder="Please select date of birth" id="dob" name="dob" required
                                        data-date-format="m-d-y">
                                    @error('dob')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Department and Program row -->
                    <div class="row">
                        <!-- First Column - Department -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department" class="form-control-label">{{ __('Department') }}</label>
                                <div class="@error('department') border border-danger rounded-3 @enderror">
                                    <select class="form-control w-100" id="department" name="department"
                                        onchange="updateProgramOptions()" required>
                                        <option value="" disabled selected>Select Department</option>
                                        <option value="College of Accounting Education">College of Accounting Education
                                        </option>
                                        <option value="College of Architecture and Fine Arts Education">College of
                                            Architecture and Fine Arts Education</option>
                                        <option value="College of Arts and Sciences">College of Arts and Sciences
                                        </option>
                                        <option value="College of Business Administration">College of Business
                                            Administration</option>
                                        <option value="College of Computing Education">College of Computing Education
                                        </option>
                                        <option value="College of Criminal Justice">College of Criminal Justice</option>
                                    </select>
                                    @error('department')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Column - Program -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program" class="form-control-label">{{ __('Program') }}</label>
                                <div class="@error('program') border border-danger rounded-3 @enderror">
                                    <select class="form-control w-100" id="program" name="program" required>
                                        <option value="" disabled selected>Select Program</option>
                                        <!-- Program options will be dynamically updated using JavaScript -->
                                    </select>
                                    @error('program')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Google Captcha -->
                            <div class="form-group" required>
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>
                    </div>
                    <!-- Your other form fields... -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Enroll Student'
                            }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    function generateStudentID() {
        // Generate a random 6-digit number
        var randomID = Math.floor(100000 + Math.random() * 900000);

        // Set the generated ID in the input field
        document.getElementById('student-id').value = randomID;
    }

    function addProgramOption(program) {
        const programSelect = document.getElementById('program');
        const option = document.createElement('option');

        // Convert program name to lowercase and replace spaces with underscores
        const programValue = program.toLowerCase().replace(/ /g, '_');

        option.value = programValue;
        option.textContent = program;
        programSelect.appendChild(option);
    }

    function updateProgramOptions() {
        const departmentSelect = document.getElementById('department');
        const programSelect = document.getElementById('program');
        const selectedDepartment = departmentSelect.value;

        // Clear previous options
        programSelect.innerHTML = '<option value="" disabled selected>Select Program</option>';

        // Add options based on the selected department
        switch (selectedDepartment) {
            case 'College of Accounting Education':
                addProgramOption('Bachelor of Science in Accountancy');
                addProgramOption('Bachelor of Science in Accounting Technology');
                addProgramOption('Bachelor of Science in Accounting Information System');
                addProgramOption('Bachelor of Science in Internal Auditing');
                addProgramOption('Bachelor of Science in Management Accounting');
                break;
            case 'College of Architecture and Fine Arts Education':
                addProgramOption('Bachelor of Science in Architecture');
                addProgramOption('Bachelor of Fine Arts and Design');
                break;
            case 'College of Arts and Sciences':
                addProgramOption('Bachelor of Arts in Communications');
                addProgramOption('Bachelor of Science in Forestry');
                addProgramOption('Bachelor of Science in Agroforestry');
                addProgramOption('Bachelor of Science in Environmental Science');
                addProgramOption('Bachelor of Science in Mathematics');
                addProgramOption('Bachelor of Arts in Journalism');
                addProgramOption('Bachelor of Arts in Broadcasting');
                addProgramOption('Bachelor of Arts in Political Science');
                addProgramOption('Bachelor of Science in Psychology');
                addProgramOption('Bachelor of Science in Social Work');
                addProgramOption('Bachelor of Science in Biology with Specializations in Plant Biology');
                addProgramOption('Bachelor of Science in Biology with Specializations in Ecology');
                addProgramOption('Bachelor of Arts in English Language');
                break;
            case 'College of Business Administration':
                addProgramOption('Bachelor of Science in Entrepreneurship');
                addProgramOption('Bachelor of Science in Legal Management');
                addProgramOption('Bachelor of Science in Real Estate Management');
                addProgramOption('Bachelor of Science in Business Administration – Business Economics');
                addProgramOption('Bachelor of Science in Business Administration – Financial Management');
                addProgramOption('Bachelor of Science in Business administration – Human Resource Management');
                addProgramOption('Bachelor of Science in Business Administration – Marketing Management');
                addProgramOption('Bachelor of Science in Business Administration – Business Analytics');
                break;
            case 'College of Computing Education':
                addProgramOption('Bachelor of Science in Information Technology');
                addProgramOption('Bachelor of Science in Computer Science');
                addProgramOption('Bachelor of Science in Information Systems');
                addProgramOption('Bachelor of Library and Information Science');
                addProgramOption('Bachelor of Science in Entertainment and Multimedia Computing – Digital Animation');
                addProgramOption('Bachelor of Science in Entertainment and Multimedia Computing – Game Development');
                addProgramOption('Bachelor of Arts in Multimedia Arts');
                break;
            case 'College of Criminal Justice':
                addProgramOption('Bachelor of Science in Criminology');
                addProgramOption('Bachelor of Science in Industrial Security Management');
                break;
            default:
                break;
        }
    }

    function addProgramOption(program) {
        const programSelect = document.getElementById('program');
        const option = document.createElement('option');

        // Set the program name and value without converting to lowercase or replacing spaces
        option.value = program;
        option.textContent = program;
        programSelect.appendChild(option);
    }

</script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Include Bootstrap Datepicker CSS -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>