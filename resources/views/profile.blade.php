
@extends('layouts.user_type.auth')

@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/profile-photo.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{ $user->email }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Platform Settings</h6>
            </div>
            <div class="card-body p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                  </div>
                </li>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0 pb-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm" style="text-align: justify">
                About Me:
              </p>
              <p>
                Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
              </p>
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; {{ $user->gender }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile Number:</strong> &nbsp; {{ $user->phone }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{ $user->location }}</li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Conversations</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Sophie B.</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Anne Marie</h6>
                    <p class="mb-0 text-xs">Awesome work, can you..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Ivanna</h6>
                    <p class="mb-0 text-xs">About files I can..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Peterson</h6>
                    <p class="mb-0 text-xs">Have a great afternoon..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                  <div class="avatar me-3">
                    <img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nick Daniel</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.footers.auth.footer')
    </div>
  </div>

  <!-- Modal for Editing Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Profile Edit Form -->
        <form>
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" value="{{ $user->first_name }}">
          </div>
          <div class="mb-3">
            <label for="middleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" value="{{ $user->middle_name }}">
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" value="{{ $user->last_name }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}">
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender">
              <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="phone" value="{{ $user->phone }}">
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" value="{{ $user->location }}">
          </div>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

