@extends('layouts.user_type.auth')



@section('content')
    <div>

        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Add Report') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form id="enrollForm" action="/save_product" enctype="multipart/form-data" method="POST" role="form text-left">
                        @csrf
                        @if ($errors->any())
                            <!-- Error message display -->
                            <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <!-- Success message display -->
                            <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
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
                                    <label for="last-name" class="form-control-label">{{ __('leader name') }}</label>
                                    <div class="@error('leader_name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Leader Name" id="leader-name"
                                            name="leader_name" required>
                                        @error('leader_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle-name" class="form-control-label">{{ __('date') }}</label>
                                    <div class="@error('date') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="date" placeholder="date"
                                            id="date" name="date" required>
                                        @error('date')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first-name" class="form-control-label">{{ __('location') }}</label>
                                    <div class="@error('location') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="location" id="location"
                                            name="location" required>
                                        @error('location')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="input-container">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lifegroup" class="form-control-label">{{ __('Lifegroup') }}</label>
                                        <div class="@error('lifegroup') border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="text" placeholder="Lifegroup" id="lifegroup" name="lifegroup[]" required>
                                            @error('lifegroup')
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gender" class="form-control-label">{{ __('Gender') }}</label>
                                        <div class="@error('gender') border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="gender" name="gender[]" required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender')
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-input" class="btn btn-primary mt-2">Add More</button>



                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-success btn-md mt-4 mb-4">{{ 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-input').addEventListener('click', function () {
            var inputContainer = document.getElementById('input-container');

            var newRow = document.createElement('div');
            newRow.classList.add('row', 'mt-2');

            var lifegroupCol = document.createElement('div');
            lifegroupCol.classList.add('col-md-4');
            var lifegroupFormGroup = document.createElement('div');
            lifegroupFormGroup.classList.add('form-group');
            var lifegroupLabel = document.createElement('label');
            lifegroupLabel.classList.add('form-control-label');
            lifegroupLabel.innerHTML = 'Lifegroup';
            var lifegroupDiv = document.createElement('div');
            var lifegroupInput = document.createElement('input');
            lifegroupInput.classList.add('form-control');
            lifegroupInput.type = 'text';
            lifegroupInput.placeholder = 'Lifegroup';
            lifegroupInput.name = 'lifegroup[]';
            lifegroupInput.required = true;

            lifegroupDiv.appendChild(lifegroupInput);
            lifegroupFormGroup.appendChild(lifegroupLabel);
            lifegroupFormGroup.appendChild(lifegroupDiv);
            lifegroupCol.appendChild(lifegroupFormGroup);

            var genderCol = document.createElement('div');
            genderCol.classList.add('col-md-2');
            var genderFormGroup = document.createElement('div');
            genderFormGroup.classList.add('form-group');
            var genderLabel = document.createElement('label');
            genderLabel.classList.add('form-control-label');
            genderLabel.innerHTML = 'Gender';
            var genderDiv = document.createElement('div');
            var genderSelect = document.createElement('select');
            genderSelect.classList.add('form-control');
            genderSelect.name = 'gender[]';
            genderSelect.required = true;

            var optionDefault = document.createElement('option');
            optionDefault.value = '';
            optionDefault.disabled = true;
            optionDefault.selected = true;
            optionDefault.innerHTML = 'Select Gender';

            var optionMale = document.createElement('option');
            optionMale.value = 'male';
            optionMale.innerHTML = 'Male';

            var optionFemale = document.createElement('option');
            optionFemale.value = 'female';
            optionFemale.innerHTML = 'Female';

            genderSelect.appendChild(optionDefault);
            genderSelect.appendChild(optionMale);
            genderSelect.appendChild(optionFemale);

            genderDiv.appendChild(genderSelect);
            genderFormGroup.appendChild(genderLabel);
            genderFormGroup.appendChild(genderDiv);
            genderCol.appendChild(genderFormGroup);

            var removeCol = document.createElement('div');
            removeCol.classList.add('col-md-2', 'd-flex', 'align-items-end');
            var removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger', 'mb-3');
            removeButton.type = 'button';
            removeButton.innerHTML = 'Remove';
            removeButton.addEventListener('click', function () {
                newRow.remove();
                toggleRemoveButtons();
            });
            removeCol.appendChild(removeButton);

            newRow.appendChild(lifegroupCol);
            newRow.appendChild(genderCol);
            newRow.appendChild(removeCol);

            inputContainer.appendChild(newRow);

            toggleRemoveButtons();
        });

        function toggleRemoveButtons() {
            var rows = document.querySelectorAll('#input-container .row');
            rows.forEach(function(row, index) {
                var removeButton = row.querySelector('.btn-danger');
                if (removeButton) {
                    removeButton.style.display = rows.length > 1 ? 'block' : 'none';
                }
            });
        }
        toggleRemoveButtons();
    });
</script>




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Include Bootstrap Datepicker CSS -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
