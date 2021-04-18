
@extends('home')

@section('sidebar')
    @include('layout.projectmanager.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.projectmanager.includes.topbar')
@endsection

@section('content')
    <div class="card">
        <h1>Hello This is Project Manager</h1>
    </div>
@endsection