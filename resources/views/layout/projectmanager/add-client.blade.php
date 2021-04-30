
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
                <h3>Add Client<h3>
            </div>
            <div class="card-body">
                <form action="{{ route('newclient') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_name_input">First Name</label>
                            <input type="text" class="form-control" id="client_name_input" name="f_name" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_name_input">Last Name</label>
                            <input type="text" class="form-control" id="client_name_input" name="l_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_address">Address</label>
                            <input type="text" class="form-control" id="client_address" name="address" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_email">Email</label>
                            <input type="email" class="form-control" id="client_email" name="email" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_contact_number">Contact Number</label>
                            <input type="number" class="form-control" id="client_contact_number" name="contact_number" required>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2" id="add_client" type="submit">Add Client</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection