
@extends('home')

@section('sidebar')
    @include('layout.admin.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.admin.includes.topbar')
@endsection

@section('content')
    <div class="card">
        <h1>Hello This is Admin</h1>
    </div>
@endsection