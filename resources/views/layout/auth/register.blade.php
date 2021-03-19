
@extends('welcome')


@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <h5>This serves as Admin Account</h5>
                            </div>
                            @if(isset($data))
                                <div class="alert alert-{{ $status }}">
                                    {{ $data[0]->msg }}
                                </div>
                            @endif
                            <form class="user" action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="f_name" class="form-control form-control-user" placeholder="First Name" value="{{ old('f_name') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="l_name" class="form-control form-control-user" placeholder="Last Name" value="{{ old('l_name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" placeholder="Username" value="{{ old('username') }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection