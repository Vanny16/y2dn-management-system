@extends('layouts.user_type.guest')

@section('content')

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-75 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/y2dn.jpg'); background-size: cover;">
        <span class="mask bg-gradient-dark opacity-3"></span>
    </div>

    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n20 opacity-">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Log in</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form role="form text-left" method="POST" action="{{ url('/register') }}">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" aria-label="Last Name" value="{{ old('username') }}">
                                @error('username')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Enter Password..." name="password" id="password" aria-label="First Name" value="{{ old('password') }}">
                                @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="text-center">
                              <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
