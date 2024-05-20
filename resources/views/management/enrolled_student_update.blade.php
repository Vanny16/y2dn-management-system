@extends('layouts.user_type.auth')



@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Product Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form method="POST" action="{{ url('/management/enrolled_student_update/' . $enrolledStudent->id) }}"
                    class="form-container" id="updateStudentForm">
                    @csrf
                    @method('PUT')
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
                        <!-- First Column - Last Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-name" class="form-control-label">{{ __('Product Name') }}</label>
                                <div class="@error('product_namel') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Product Name" id="product-name"
                                        name="product_name" value="{{ $enrolledStudent->product_name }}" required>
                                    @error('product_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Column - First Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first-name" class="form-control-label">{{ __('Price') }}</label>
                                <div class="@error('price') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Price" id="first-name"
                                        name="price" value="{{ $enrolledStudent->price }}" required>
                                    @error('price')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Third Column - Middle Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantitystock" class="form-control-label">{{ __('Stock Quantity') }}</label>
                                <div class="@error('quantitystock') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Quantity" id="quantitystock"
                                        name="quantitystock" value="{{ $enrolledStudent->quantitystock }}" required>
                                    @error('quantitystock')
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
                                <label for="category" class="form-control-label">{{ __('Category') }}</label>
                                <div class="@error('category') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="{{ $enrolledStudent->category }}" selected>{{
                                            $enrolledStudent->category
                                            }}
                                        </option>
                                        <option value="" disabled selected>Select Category</option>
                                        <option value="Fruits">Fruits</option>
                                        <option value="Vegetables">Vegetables</option>
                                        <option value="Meat">Meat</option>
                                        <option value="Seafood">Seafood</option>
                                    </select>
                                    @error('category')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Column - Mobile Number -->
                        
                        <!-- Third Column - Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Discount') }}</label>
                                <div class="@error('discount') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="Enter Discount" id="discount"
                                        name="discount" value="{{ $enrolledStudent->discount }}" required>
                                    @error('discount')
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
                                <label for="product-image" class="form-control-label">{{ __('Product Image') }}</label>
                                <div class="@error('product_image') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" id="product-image" name="product_image" value="{{ $enrolledStudent->product_image }}" required>
                                    @error('product_image')
                                    <p class=" text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth column with date picker -->
                        
                    </div>
                    <!-- Department and Program row -->
                    <div class="row">
                        <!-- First Column - Department -->
                        
                        <!-- Second Column - Program -->
                        
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update Product'
                            }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


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