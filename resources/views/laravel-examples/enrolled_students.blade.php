<!-- enrolled_students.blade.php -->

@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Enrolled Students</h5>
                        </div>
                        <a href="/enroll_student" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Enroll Student</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Student ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Enrolled
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrolledStudents as $enrolledStudent)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $enrolledStudent->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $enrolledStudent->student_id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $enrolledStudent->last_name }}, {{ $enrolledStudent->first_name }} {{ substr($enrolledStudent->middle_name, 0, 1) }}.
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $enrolledStudent->created_at->format('d/m/y') }}</span>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $enrolledStudent->email }}</p>
                                        </td>
                                        <td style="text-align:center">
                                            <a class="btn btn-primary btn-sm view-btn" 
                                                data-toggle="modal" 
                                                data-target="#viewStudentModal"
                                                data-id="{{ $enrolledStudent->id }}"
                                                data-student-id="{{ $enrolledStudent->student_id }}"
                                                data-date-enrolled="{{ $enrolledStudent->created_at->format('d/m/y') }}"
                                                data-last-name="{{ $enrolledStudent->last_name }}"
                                                data-first-name="{{ $enrolledStudent->first_name }}"
                                                data-middle-name="{{ $enrolledStudent->middle_name }}"
                                                data-dob="{{ $enrolledStudent->dob }}"
                                                data-address="{{ $enrolledStudent->address }}"
                                                data-department="{{ $enrolledStudent->department }}"
                                                data-program="{{ $enrolledStudent->program }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm" href="#}">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="event.preventDefault(); 
                                                if (confirm('Are you sure you want to delete this student record?')) 
                                                    document.getElementById('delete-form-{{ $enrolledStudent->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $enrolledStudent->id }}" action="{{ route('delete_enrollee', $enrolledStudent->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
                <div class="row mb-2">
                    <div class="col-6">
                        <strong>Student ID:</strong>
                        <span>{{ $enrolledStudent->student_id }}</span>
                    </div>
                    <div class="col-6">
                        <strong>Date Enrolled:</strong>
                        <span>{{ $enrolledStudent->created_at->format('d/m/y') }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <strong>Last Name:</strong>
                        <span>{{ $enrolledStudent->last_name }}</span>
                    </div>
                    <div class="col-4">
                        <strong>First Name:</strong>
                        <span>{{ $enrolledStudent->first_name }}</span>
                    </div>
                    <div class="col-4">
                        <strong>Middle Name:</strong>
                        <span>{{ $enrolledStudent->middle_name }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>Date of Birth:</strong>
                        <span>{{ $enrolledStudent->dob }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>Address:</strong>
                        <span>{{ $enrolledStudent->address }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <strong>Department:</strong>
                        <span>{{ $enrolledStudent->department }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>Program:</strong>
                        <span>{{ $enrolledStudent->program }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


