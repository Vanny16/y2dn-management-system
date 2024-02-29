@extends('layouts.user_type.auth')

@section('content')

    <div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <!-- Error message display -->
                    <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert" id="alert-error">
                        <span class="alert-text text-white">
                            {{ $errors->first() }}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                <div class="m-3 alert alert-danger alert-dismissible fade show" id="alert-error" role="alert">
                    <span class="alert-text text-white">
                        {{ session('error') }}
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>


        </div>
        <div class="row">
            <div class="col-12">


                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <div class="">
                                <a class="btn bg-gradient-primary btn-sm " data-toggle="modal"
                                data-target="#addStaffModal"> <i class="fas fa-user"></i>&nbsp; Add Staff
                            </a>

                            <a class="btn bg-gradient-warning btn-sm" data-toggle="modal"
                            data-target="#addRoleModal"><i class="fas fa-user-shield"></i>&nbsp; Create Role
                        </a>
                            </div>


                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            role
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($users_list)
                                        @foreach ($users_list as $user)
                                            <tr>
                                                <td class="text-center">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->last_name }},
                                                        {{ $user->first_name }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->user_role }}</p>
                                                </td>

                                                <td class="text-center">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->created_at }}</p>
                                                </td>

                                                <td style="text-align:center">
                                                    <a class="btn btn-primary btn-xs view-btn text-white" data-toggle="modal"
                                                        data-target="#viewStudentModal{{ $user->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-secondary btn-xs view-btn text-white"
                                                        href="{{ route('management.enrolled_student_update', $user->id) }}">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>

                                                    <a class="btn btn-danger btn-xs view-btn text-white"
                                                    href="{{ route('management.enrolled_student_update', $user->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header  bg-gradient-primary">
                    <h5 class="modal-title" id="viewStudentModalLabel" style="color: white;">ADD STAFF</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <form method="POST" action="/management/add_staff/" class="form-container" id="updateStudentForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- First Column - Last Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last-name" class="form-control-label">{{ __('Last Name') }}</label>
                                    <div class="@error('last_name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Last Name" id="last-name"
                                            name="last_name" value="" required>
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
                                            name="first_name" value="" required>
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
                                        <input class="form-control" type="text" placeholder="Middle Name"
                                            id="middle-name" name="middle_name" value="" required>
                                        @error('middle_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Username" class="form-control-label">{{ __('Username') }}</label>
                                    <div class="@error('username') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Username" id="user-name"
                                            name="username" value="" required>
                                        @error('username')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Password" class="form-control-label">{{ __('Password') }}</label>
                                    <div class="@error('user_name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="password" id="password"
                                            name="password" value="" required>
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <!-- Second Column - Mobile Number -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">{{ __('Mobile Number') }}</label>
                                    <div class="@error('phone') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="number" maxlength="10"
                                            placeholder="9123456789" id="phone" name="phone" value=""
                                            required>
                                        @error('phone')
                                            <p class=" text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender" class="form-control-label">{{ __('Gender') }}</label>
                                    <div class="@error('gender') border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('gender')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('email') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="email" placeholder="user@example.com"
                                            id="email" name="email" value="" required>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_role" class="form-control-label">{{ __('User role') }}</label>
                                    <div class="@error('user_role') border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="user_role" name="user_role" required>
                                            @foreach ($roles_list as $role)
                                                <option value="{{ $role->id }}">{{ $role->user_role }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md">{{ 'Save' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  bg-gradient-warning">
                    <h5 class="modal-title" id="viewStudentModalLabel" style="color: white;">ADD ROLE</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <form method="POST" action="/management/add_role/" class="form-container" id="updateStudentForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user_role" class="form-control-label">{{ 'Role' }}</label>
                            <div class="@error('user_role') border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="ex.Admin..."
                                    id="user_role" name="user_role" value="" required>
                                @error('user_role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-warning btn-md">{{ 'Save' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

<!-- Add these links to the head section of your HTML -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    // Automatically close alerts after 5 seconds with a fading effect
    window.setTimeout(function() {
        var errorAlert = document.getElementById('alert-error');
        var successAlert = document.getElementById('alert-success');

        if (errorAlert) {
            errorAlert.style.transition = "opacity 2s"; // Adjust the duration as needed
            errorAlert.style.opacity = 0;
            setTimeout(function() {
                errorAlert.style.display = "none";
            }, 2000); // Adjust the duration to match the transition duration
        }

        if (successAlert) {
            successAlert.style.transition = "opacity 2s"; // Adjust the duration as needed
            successAlert.style.opacity = 0;
            setTimeout(function() {
                successAlert.style.display = "none";
            }, 000); // Adjust the duration to match the transition duration
        }
    }, 3000); // Adjust the total duration as needed
</script>

