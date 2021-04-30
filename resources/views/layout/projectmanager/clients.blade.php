
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
                @foreach($data['client'] as $client)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    {{ $client["client_f_name"] . " " . $client["client_l_name"] }}
                                </div>
                                <div class="col-2">
                                    <a href="clients/showclient/{{ $client['id'] }}" class="btn btn-primary">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection