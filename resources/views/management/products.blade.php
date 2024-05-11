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
                            <h5 class="mb-0">Products</h5>
                        </div>
                        <a href="/add_products" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                            Add Products</a>
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
                <hr>
                <div class="card-body pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="enrolledStudentsTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product Image
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewProducts as $prod_details)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $prod_details->product_id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/products_image/' . $prod_details->product_image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px;">
                                    </td>



                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                           {{ $prod_details->product_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{
                                            $prod_details->category }}</span>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $prod_details->product_price }}</p>
                                    </td>

                                    <td style="text-align:center">
                                        <a class="btn btn-primary btn-sm view-btn text-white" data-toggle="modal"
                                            data-target="#viewStudentModal{{ $prod_details->product_id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-secondary btn-sm view-btn text-white"
                                            href="{{ route('management.enrolled_student_update', $prod_details->product_id) }}">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm text-white" href="#"
                                            onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete this student record?'))
                                                    document.getElementById('delete-form-{{ $prod_details->product_id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $prod_details->product_id }}"
                                            action="{{ route('delete_enrollee', $prod_details->product_id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                {{-- <div class="modal fade" id="viewStudentModal{{ $prod_details->product_id }}" tabindex="-1"
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
                                                    <div class="col-6">
                                                        <strong>Date Enrolled:</strong>
                                                        <span>{{ $enrolledStudent->created_at->format('d/m/y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <strong>Student ID:</strong>
                                                        <span>{{ $enrolledStudent->student_id }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <strong>Mobile Number:</strong>
                                                        <span>{{ $enrolledStudent->mobile_number }}</span>
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
                                                    <div class="col-12">
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
                                </div> --}}
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

<script>
    $(document).ready(function () {
        var table = $('#enrolledStudentsTable').DataTable();
        $('#search').on('keyup', function () {
            table.search($(this).val()).draw();
        });
    });
</script>

@endsection

<!-- Add these links to the head section of your HTML -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Add these links to the head section of your HTML -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
