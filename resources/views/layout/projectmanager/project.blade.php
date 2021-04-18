
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
                <h3>Add Project > <b id="project_name">New Project</b></h3>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success">
                {{ Session::get('success')}}
                </div>
                @endif
                <div class="my-3 min-vw-25" id="chart_div"></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="project_name_input">Project Name</label>
                            <input type="text" class="form-control" id="project_name_input" placeholder="Project Name" value="New Project">
                        </div>
                        <div class="form-group">
                            <label for="project_address">Project Address</label>
                            <input type="text" class="form-control" id="project_address_input" placeholder="Project Address">
                        </div>
                        <div class="form-group">
                            <label for="client_id">Select Client</label>
                            <select name="client_id" id="client_id">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <form action="#" id="plan-details">
                    <div class="row" id="plan_input">
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_name_input">Plan Name</label>
                                <input type="text" id="plan_name_input" class="form-control" placeholder="Plan Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_date_start">Plan Date Start</label>
                                <input type="date" id="plan_date_start" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_date_end">Plan Date End</label>
                                <input type="date" id="plan_date_end" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_parent">Plan Dependencies</label>
                                <select id="plan_parent" class="custom-select">
                                    <option value="" disabled selected>Select Dependencies</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_priority">Plan Priority</label>
                                <select id="plan_priority" class="custom-select">
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-2" id="plan_btn">Add Plan</button>
                </form>
                <table class="table table-striped" id="plan_table">
                    <thead>
                        <th>Plan Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Dependency</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <button class="btn btn-success mt-2" id="submit_plan">Submit Plan</button>
            </div>
        </div>
        <div class="modal fade" id="plan_modal" tabindex="-1" role="dialog" aria-labelledby="plan_name" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Plan: <b id="plan_name"></b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="task_name_input">Task Name</label>
                                    <input type="text" id="task_name_input" class="form-control" placeholder="Task Name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="task_priority">Task Priority</label>
                                    <select id="task_priority" class="custom-select">
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="task_user">Assign To</label>
                                    <select id="task_user" class="custom-select">
                                        @foreach($data["users"] as $user)
                                            <option value="{{ $user['id'] }}">{{ $user["f_name"] . " " . $user["l_name"] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="plan_tasks"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection