@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Student Documents</h5>
                        </div>
                        <a href="/enroll_student" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                            Upload Document</a>
                    </div>
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
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Student ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Last Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        First Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Middle Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentDocuments as $studentDocuments)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->student_id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->last_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->first_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $studentDocuments->middle_name }}
                                        </p>
                                    </td>
                                    <td style="text-align:center">
                                        <a class="btn btn-primary btn-sm view-btn text-white" data-toggle="modal"
                                            data-target="#viewStudentModal{{ $studentDocuments->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-secondary btn-sm view-btn text-white"
                                            href="{{ route('management.enrolled_student_update', $studentDocuments->id) }}">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm text-white" href="#"
                                            onclick="event.preventDefault(); 
                                                if (confirm('Are you sure you want to delete this student record?')) 
                                                    document.getElementById('delete-form-{{ $studentDocuments->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $studentDocuments->id }}"
                                            action="{{ route('delete_enrollee', $studentDocuments->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="viewStudentModal{{ $studentDocuments->id }}" tabindex="-1"
                                    aria-labelledby="viewStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewStudentModalLabel">Student Information
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" id="modal-body-content">
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <strong>Student ID:</strong>
                                                        <span>{{ $studentDocuments->student_id }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <strong>Last Name:</strong>
                                                        <span>{{ $studentDocuments->last_name }}</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <strong>First Name:</strong>
                                                        <span>{{ $studentDocuments->first_name }}</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <strong>Middle Name:</strong>
                                                        <span>{{ $studentDocuments->middle_name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection



<!-- Add these links to the head section of your HTML -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>