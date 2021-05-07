
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
        @foreach($data["projects"] as $project)
        <div class="card p-3  mb-3">
            <div class="d-flex">
                <div class="col-lg-10 col-md-6">
                    <h3>{{$project["project_name"]}}</h3>
                    <p>Status: <b class="text-primary">{{$project["project_status"]}}</b></p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <a href="/projects/project/{{ $project['project_id'] }}" class="btn btn-primary">Open</a>
                    @if($project["project_status"] != "approved")
                        <a href="{{ route('removeproject', $project['project_id'] ) }}" class="btn btn-danger" >Delete</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    function init_data(){
        
    }
    
    $(document).ready(function(){

    });
</script>
@endsection