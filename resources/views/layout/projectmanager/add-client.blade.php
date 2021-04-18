
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
                <h3>Add Client > <b id="client_name">Client Name</b></h3>
            </div>
            <div class="card-body">
                <div class="my-3 min-vw-25" id="chart_div"></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="client_name_input">lient Name</label>
                            <input type="text" class="form-control" id="client_name_input" placeholder="Client Name" value="Client Name">
                        </div>
                        <div class="form-group">
                            <label for="client_address">Client Address</label>
                            <input type="text" class="form-control" id="client_address_input" placeholder="Client Address">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-2" id="submit_plan">Submit Plan</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection