@extends('welcome')

@section('content')
        <div class="row justify-content-center">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Welcome To</h3>
                    <h1>Construction Management Performance Monitoring System</h1>
                    <h6>By: Wendale Dy, Shandy Dominguez</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-admin-list" data-toggle="list" href="#list-admin" role="tab" aria-controls="admin">Admin</a>
                                <a class="list-group-item list-group-item-action" id="list-hr-list" data-toggle="list" href="#list-hr" role="tab" aria-controls="hr">Human Resource</a>
                                <a class="list-group-item list-group-item-action" id="list-tk-list" data-toggle="list" href="#list-tk" role="tab" aria-controls="tk">Time Keeper</a>
                                <a class="list-group-item list-group-item-action" id="list-civil-list" data-toggle="list" href="#list-civil" role="tab" aria-controls="civil">Civil Engineer</a>
                                <a class="list-group-item list-group-item-action" id="list-pm-list" data-toggle="list" href="#list-pm" role="tab" aria-controls="pm">Project Manager</a>
                                <a class="list-group-item list-group-item-action" id="list-foreman-list" data-toggle="list" href="#list-foreman" role="tab" aria-controls="foreman">Foreman</a>
                                <a class="list-group-item list-group-item-action" id="list-expediter-list" data-toggle="list" href="#list-expediter" role="tab" aria-controls="expediter">Expediter </a>
                                <a class="list-group-item list-group-item-action" id="list-client-list" data-toggle="list" href="#list-client" role="tab" aria-controls="client">Client </a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent" >
                                <div class="tab-pane fade show active" id="list-admin" role="tabpanel" aria-labelledby="list-admin-list">
                                    <p>Ang admin maka add ug employee like HR, Civil Engineer, Project Manager ug maka kita sa mga sales and shit</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-hr" role="tabpanel" aria-labelledby="list-hr-list">
                                    <p>Hr mao ni ang mo add ug mga employee ug mag manage sa payroll</p>
                                    <a href="{{ route('loginhumanresource') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-tk" role="tabpanel" aria-labelledby="list-hr-list">
                                    <p>Time Keeper Mao ni sila ang mo attendance nga absenot nga mga trabahante</p>
                                </div>
                                <div class="tab-pane fade" id="list-civil" role="tabpanel" aria-labelledby="list-civil-list">
                                    <p>Civil Engineer kay mao na ang mo monitor sa project</p>
                                    <a href="{{ route('logincivilengineer') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-pm" role="tabpanel" aria-labelledby="list-pm-list">
                                    <p>Project Manager mao ni ang mo plano sa project ug mag manage sa time frame</p>
                                    <a href="{{ route('loginprojectmanager') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-foreman" role="tabpanel" aria-labelledby="list-foreman-list">
                                    <p>Foreman Mao ni sila ang hatagan always sa task tas sila na bahala mo sugo sa mga laborers, mason, etc..</p>
                                    <a href="{{ route('loginforeman') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-expediter" role="tabpanel" aria-labelledby="list-expediter-list">
                                    <p>Expediter mao ni ang mo manage sa mga supplies</p>
                                    <a href="{{ route('loginexpediter') }}" class="btn btn-primary">Login</a>
                                </div>
                                <div class="tab-pane fade" id="list-client" role="tabpanel" aria-labelledby="list-expediter-list">
                                    <p>Client Mao ni sila ang moreklamo ug maka kita sa progress sa ilang balay litsi!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection