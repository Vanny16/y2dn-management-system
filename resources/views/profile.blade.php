@extends('layouts.user_type.auth')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
  <div class="container-fluid">
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
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('../assets/img/homebg1.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-success opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="../assets/img/profile-photo.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ DB::table('user_roles')->where('id', $user->user_role)->value('user_role') }}

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
          
          <div class="card-body">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Role:</strong> &nbsp;
                {{ DB::table('user_roles')->where('id', $user->user_role)->value('user_role') }}
              </li>


              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}
                <a href="#" class="fas fa-user-edit text-secondary text-sm float-end" data-bs-toggle="modal"
                  data-bs-target="#editEmailModal" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Edit Email"></a>

              </li>

              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Password:</strong> &nbsp; *******
                <a href="#" class="fas fa-user-edit text-secondary text-sm float-end" data-bs-toggle="modal"
                  data-bs-target="#editPasswordModal" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Edit Password"></a>

              </li>

              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Date Created:</strong> &nbsp;{{ $user->created_at }}
              </li>

              <li class="list-group-item border-0 px-0">

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
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Edit Profile"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <p class="text-sm" style="text-align: justify">
            </p>
            <p>
              {{ $user->about_me }}
            </p>
            <ul class="list-group">
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Full
                  Name:</strong> &nbsp; {{ $user->first_name }} {{ $user->middle_name }}
                {{ $user->last_name }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong>
                &nbsp; {{ $user->gender }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile
                  Number:</strong> &nbsp;
                {{ $user->phone }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; {{
                $user->location }}</li>
            
              
            </ul>
          </div>
        </div>
      </div>
 

<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your form for editing email here -->
        <form method="POST" action="/change_email/">
          @csrf
          <div class="mb-3">
            <label for="newEmail" class="form-label">New Email:</label>
            <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter new email"
              required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Enter Password:</label>
            <input type="password" class="form-control" id="password" name="password"
              placeholder="Enter Current Password" required>
          </div>
          <!-- Add any other necessary form fields -->

          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Password Modal -->
<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your form for editing password here -->
        <form method="POST" action="/change_password/">
          @csrf
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Current Password:</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword"
              placeholder="Enter current password" required>
          </div>

          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword"
              placeholder="Enter new password" required>
          </div>
          <div class="mb-3">
            <label for="ConfirmNewPassword" class="form-label">Confirm new Password:</label>
            <input type="password" class="form-control" id="ConfirmNewPassword" name="ConfirmNewPassword"
              placeholder="Confirm new password" required>
          </div>

          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
        // Add a test click event to check if jQuery is working
        $('.btn-link').click(function() {
            // alert('Button clicked!');
            console.log("Button clicked"); // Check if this message appears in the console
            var recipientId = $(this).data('chat-to');
            $('#chatForm input[name="recipient_id"]').val(recipientId);
            loadConversationContent(recipientId); // Call the function to load conversation content
        });

        // Function to load conversation content via AJAX
        function loadConversationContent(recipientId) {
            $.ajax({
                url: "{{ route('load-conversation') }}",
                type: "GET",
                data: {
                    recipient_id: recipientId
                },
                success: function(response) {
                    console.log(response); // Log the response to ensure it's what you expect.

                    var modalBody = $('#chatModal' + recipientId + ' .offcanvas-body'); // Adjust this selector based on your actual modal ID and structure.
                    modalBody.empty(); // Clear existing content.

                    if (response.length > 0) {
                        response.forEach(function(chat) {
                            var messageElement = $('<p></p>').text(chat.cht_message);
                            // Add a CSS class based on the value of cht_from
                            if (chat.cht_from == {{ auth()->id() }}) {
                                messageElement.addClass('text-end');
                            } else {
                                messageElement.addClass('text-start');
                            }
                            modalBody.append(messageElement); // Append the message to the modal body.
                        });
                    } else {
                        modalBody.text('No conversation found.'); // Display a message if no conversation exists.
                    }
                    // Assuming you've correctly initialized Bootstrap's modal via JavaScript or data attributes.
                    var myModal = new bootstrap.Offcanvas(document.getElementById('chatModal' + recipientId)); // Adjust this ID based on your modal's ID.
                    myModal.show(); // Show the modal with the updated content.
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    // Automatically close alerts after 5 seconds with a fading effect
    window.setTimeout(function() {
        var errorAlert = document.getElementById('alert-error');
        var successAlert = document.getElementById('alert-success');

        if (errorAlert) {
            errorAlert.style.transition = "opacity 2s"; // Adjust the duration as needed
            errorAlert.style.opacity = 0;
            setTimeout(function() {
                errorAlert.style.display = "none";
            }, 3000); // Adjust the duration to match the transition duration
        }

        if (successAlert) {
            successAlert.style.transition = "opacity 2s"; // Adjust the duration as needed
            successAlert.style.opacity = 0;
            setTimeout(function() {
                successAlert.style.display = "none";
            }, 3000); // Adjust the duration to match the transition duration
        }
    }, 3000); // Adjust the total duration as needed
</script>
@endsection
