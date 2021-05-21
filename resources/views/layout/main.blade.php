@extends('welcome')

@section('content')
        <div class="row justify-content-center">
            <div class="card mt-10 border border-warning border-5">
                <CENTER>
                <div class="card-header">
                    <h5>WELCOME TO</h5>
                    <h1 style="letter-spacing: 4px; color: #3784a5;">CMPM System</h1>
                    <!-- <h7>By: Wendale Dy, Shandy Dominguez</h7> -->
                </div>
                </CENTER>
                <div class="card-body">
                    <div class="col">
                        <div>
                        <center>
                        <h5>LOGIN AS: </h5>
                        </center>
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-admin-list" data-toggle="list" href="#list-admin" role="tab" aria-controls="admin">CEO</a>
                                <a class="list-group-item list-group-item-action" id="list-hr-list" data-toggle="list" href="#list-hr" role="tab" aria-controls="hr">Human Resource</a>
                                <!-- <a class="list-group-item list-group-item-action" id="list-tk-list" data-toggle="list" href="#list-tk" role="tab" aria-controls="tk">Time Keeper</a> -->
                                <a class="list-group-item list-group-item-action" id="list-civil-list" data-toggle="list" href="#list-civil" role="tab" aria-controls="civil">Civil Engineer</a>
                                <a class="list-group-item list-group-item-action" id="list-pm-list" data-toggle="list" href="#list-pm" role="tab" aria-controls="pm">Project Manager</a>
                                <a class="list-group-item list-group-item-action" id="list-foreman-list" data-toggle="list" href="#list-foreman" role="tab" aria-controls="foreman">Foreman</a>
                                <a class="list-group-item list-group-item-action" id="list-expediter-list" data-toggle="list" href="#list-expediter" role="tab" aria-controls="expediter">Expediter </a>
                                <a class="list-group-item list-group-item-action" id="list-client-list" data-toggle="list" href="#list-client" role="tab" aria-controls="client">Client </a>
                            </div>
                        </div>
                        <div>
                            <div class="tab-content" id="nav-tabContent" >
                                <div class="tab-pane fade show active" id="list-admin" role="tabpanel" aria-labelledby="list-admin-list"><br>
                                    <!-- <p>Ang CEO maka add ug employee like HR, Civil Engineer,</P>
                                    <P> Project Manager ug maka kita sa mga sales and shit</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-hr" role="tabpanel" aria-labelledby="list-hr-list"><br>
                                    <!-- <p>Hr mao ni ang mo add ug mga employee ug mag manage sa payroll</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('loginhumanresource') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="list-tk" role="tabpanel" aria-labelledby="list-hr-list">
                                    <p>Time Keeper Mao ni sila ang mo attendance nga absenot nga mga trabahante</p>
                                </div> -->
                                <div class="tab-pane fade" id="list-civil" role="tabpanel" aria-labelledby="list-civil-list"><br>
                                    <!-- <p>Civil Engineer kay mao na ang mo monitor sa project</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('logincivilengineer') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-pm" role="tabpanel" aria-labelledby="list-pm-list"><br>
                                    <!-- <p>Project Manager mao ni ang mo plano sa project ug mag manage sa time frame</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('loginprojectmanager') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-foreman" role="tabpanel" aria-labelledby="list-foreman-list"><br>
                                    <!-- <p>Foreman Mao ni sila ang hatagan always sa task tas sila </p>
                                    <p>na bahala mo sugo sa mga laborers, mason, etc..</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('loginforeman') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-expediter" role="tabpanel" aria-labelledby="list-expediter-list"><br>
                                    <!-- <p>Expediter mao ni ang mo manage sa mga supplies</p> -->
                                    <div class="d-flex justify-content-center">
                                    <a href="{{ route('loginexpediter') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-client" role="tabpanel" aria-labelledby="list-expediter-list">
                                    <!-- <p>Client Mao ni sila ang moreklamo ug maka kita sa progress sa ilang balay</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection