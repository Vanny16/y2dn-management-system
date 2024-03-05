@extends('layouts.user_type.auth')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
  <div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4"
      style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
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
            <h6 class="mb-0">Account Settings</h6>
            <div class="form-check form-switch mt-3 ps-0">
              <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
              <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email
                me when someone mentions me</label>
            </div>
          </div>
          <div class="card-body">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Role:</strong> &nbsp; Alec M. Thompson
              </li>

              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Email:</strong> &nbsp; Alec M. Thompson
                <i class="fas fa-user-edit text-secondary text-sm float-end" data-bs-toggle="tooltip"
                  data-bs-placement="top" title="Edit Email"></i>
              </li>

              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Password:</strong> &nbsp; Alec M. Thompson
                <i class="fas fa-user-edit text-secondary text-sm float-end" data-bs-toggle="tooltip"
                  data-bs-placement="top" title="Edit Password"></i>
              </li>

              <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">Date Created:</strong> &nbsp; Alec M. Thompson
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
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{
                $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; {{
                $user->gender }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile Number:</strong> &nbsp;
                {{ $user->phone }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{
                $user->location }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">About Me:</strong> &nbsp; {{
                $user->about_me }}</li>
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
              @forelse ($chats as $chat)
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                <div class="avatar me-3">
                  <img src="../assets/img/profile-photo.jpg" alt="kal" class="border-radius-lg shadow">
                </div>
                <div class="d-flex align-items-start flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">{{ $chat->first_name }} {{ $chat->last_name }}</h6>
                  <p class="mb-0 text-xs">{{ $chat->cht_message }}</p>
                </div>
                <button class="btn btn-link pe-3 ps-0 mb-0 ms-auto" data-bs-toggle="offcanvas"
                  data-bs-target="#chatModal{{ $chat->cht_to }}" data-chat-to="{{ $chat->cht_to }}">Reply</button>
              </li>

              {{-- ! OFF CANVAS LEFT--}}
              <div class="offcanvas offcanvas-start" tabindex="-1" id="chatModal{{ $chat->cht_to }}"
                aria-labelledby="offcanvasBothLabel" data-bs-scroll="true">
                <div class="offcanvas-header">
                  <h5 id="offcanvasBothLabel" class="offcanvas-title">{{ $chat->first_name }} {{ $chat->last_name }}</h5>
                  <button type="button" class="close text-reset text-danger" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
                </div>
                <div class="offcanvas-body my-auto mx-0 flex-grow-0">

                </div>
              </div>
              {{-- ! --}}

              {{-- ? Modal for conversations/chats with selected user--}}
              {{-- <div class="modal fade" id="chatModal{{ $chat->cht_to }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{ $chat->first_name }} {{ $chat->last_name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <form id="chatForm" action="{{ route('send-chat') }}" method="post">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $chat->cht_from }}">
                        <div class="d-flex mx-auto">
                          <input class="form-control me-2" style="flex-basis: 100%" name="message" id="message"
                            required></input>
                          <button type="submit" style="flex-basis: 20%" class="btn btn-primary mt-2">Send</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> --}}
              @empty
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">No recent chats found.</li>
              @endforelse
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                <a class="btn btn-link mx-auto" href="javascript:;">View all chats</a>
              </li>
              {{-- ? --}}
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 mt-4">
        <div class="card mb-4">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-1">Projects</h6>
            <p class="text-sm">Architects design houses</p>
          </div>
          <div class="card-body p-3">
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card card-blog card-plain">
                  <div class="position-relative">
                    <a class="d-block shadow-xl border-radius-xl">
                      <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                        class="img-fluid shadow border-radius-xl">
                    </a>
                  </div>
                  <div class="card-body px-1 pb-0">
                    <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                    <a href="javascript:;">
                      <h5>
                        Modern
                      </h5>
                    </a>
                    <p class="mb-4 text-sm">
                      As Uber works through a huge amount of internal management turmoil.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                      <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                      <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Elena Morison">
                          <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Ryan Milly">
                          <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Nick Daniel">
                          <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Peterson">
                          <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card card-blog card-plain">
                  <div class="position-relative">
                    <a class="d-block shadow-xl border-radius-xl">
                      <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow"
                        class="img-fluid shadow border-radius-lg">
                    </a>
                  </div>
                  <div class="card-body px-1 pb-0">
                    <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                    <a href="javascript:;">
                      <h5>
                        Scandinavian
                      </h5>
                    </a>
                    <p class="mb-4 text-sm">
                      Music is something that every person has his or her own specific opinion about.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                      <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                      <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Nick Daniel">
                          <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Peterson">
                          <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Elena Morison">
                          <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Ryan Milly">
                          <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card card-blog card-plain">
                  <div class="position-relative">
                    <a class="d-block shadow-xl border-radius-xl">
                      <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                        class="img-fluid shadow border-radius-xl">
                    </a>
                  </div>
                  <div class="card-body px-1 pb-0">
                    <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                    <a href="javascript:;">
                      <h5>
                        Minimalist
                      </h5>
                    </a>
                    <p class="mb-4 text-sm">
                      Different people have different taste, and various types of music.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                      <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                      <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Peterson">
                          <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Nick Daniel">
                          <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Ryan Milly">
                          <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                          data-bs-placement="bottom" title="Elena Morison">
                          <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card h-100 card-plain border">
                  <div class="card-body d-flex flex-column justify-content-center text-center">
                    <a href="javascript:;">
                      <i class="fa fa-plus text-secondary mb-3"></i>
                      <h5 class=" text-secondary"> New project </h5>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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



</script>
@endsection