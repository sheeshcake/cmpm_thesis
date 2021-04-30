
@extends('home')

@section('sidebar')
    @include('layout.projectmanager.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.projectmanager.includes.topbar')
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="scrollable">
        <div class="card">
            <div class="card-header">
                <h3>{{ $data['client'][0]['client_f_name'] . " " . $data['client'][0]['client_l_name'] }}<h3>
            </div>
            <div class="card-body">
                <form action="{{ route('updateclient') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['client'][0]['id'] }}">
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_name_input">First Name</label>
                            <input type="text" class="form-control" id="client_name_input" name="f_name" value="{{ $data['client'][0]['client_f_name'] }}" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_name_input">Last Name</label>
                            <input type="text" class="form-control" id="client_name_input" name="l_name" value="{{ $data['client'][0]['client_l_name'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_address">Address</label>
                            <input type="text" class="form-control" id="client_address" name="address" value="{{ $data['client'][0]['client_address'] }}" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_email">Email</label>
                            <input type="email" class="form-control" id="client_email" name="email" value="{{ $data['client'][0]['client_email'] }}" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_contact_number">Contact Number</label>
                            <input type="number" class="form-control" id="client_contact_number" name="contact_number" value="{{ $data['client'][0]['client_contact_number'] }}" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_contact_number">Username</label>
                            <input type="number" class="form-control" id="client_contact_number" name="contact_number" value="{{ $data['client'][0]['client_username'] }}" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_contact_number">Password</label>
                            <input type="password" class="form-control" id="client_contact_number" name="contact_number" value="{{ $data['client'][0]['client_contact_number'] }}" required>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2" id="add_client" type="submit">Update Client</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection