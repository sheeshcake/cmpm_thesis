
@extends('home')

@section('sidebar')
    @include('layout.admin.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.admin.includes.topbar')
@endsection

@section('content')
<form action="{{ route('updateemployee') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data['user_data'][0]->user_id }}">
    <div class="row">
        @if(Session::has('msg'))
            <div class="alert alert-success w-75">{!! \Session::get('msg') !!}</div>
        @endif
        <input type="submit" name="submit" value="Save" class="btn btn-lg btn-primary ml-auto mb-3 mr-5">
    </div>
    <div class="row">
        <div class="col-10">
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Add Employee</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="f_name">First Name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name" value="{{ $data['user_data'][0]->f_name }}" reqiured>
                                </div>
                                <div class="col">
                                    <label for="l_name">Last Name</label>
                                    <input type="text" class="form-control" id="l_name" name="l_name" value="{{ $data['user_data'][0]->l_name }}" reqiured>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="user_contact_number">Contact Number</label>
                                    <input type="number" max="09999999999" class="form-control" name="user_contact_number" id="user_contact_number" value="{{ $data['user_data'][0]->user_contact_number }}" required>
                                </div>
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ $data['user_data'][0]->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="user_gender">Gender</label>
                                    <select name="user_gender" class="custom-select" id="user_gender" required>
                                        <option value="male" @if($data['user_data'][0]->user_gender == "male") {{ "selected" }} @endif>Male</option>
                                        <option value="female" @if($data['user_data'][0]->user_gender == "female") {{ "selected" }} @endif>Female</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="user_civil_status">Civil Status</label>
                                    <select name="user_civil_status" class="custom-select" id="user_civil_status" required>
                                        <option value="single" @if($data['user_data'][0]->user_civil_status == "single") {{ "selected" }} @endif>Single</option>
                                        <option value="married" @if($data['user_data'][0]->user_civil_status == "married") {{ "selected" }} @endif>Married</option>
                                        <option value="civilpartner" @if($data['user_data'][0]->user_civil_status == "civilpartner") {{ "selected" }} @endif>Civil Partner</option>
                                        <option value="divoreced" @if($data['user_data'][0]->user_civil_status == "divorced") {{ "selected" }} @endif>Divorced</option>
                                        <option value="widowed" @if($data['user_data'][0]->user_civil_status == "widowed") {{ "selected" }} @endif>Widowed</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="user_regligion">Religion</label>
                                    <input type="text" name="user_religion" class="form-control" id="user_religion" value="{{ $data['user_data'][0]->user_religion }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="user_birthday">Birthday</label>
                                    <input type="date" class="form-control" id="user_birthday" name="user_birthday" value="{{ $data['user_data'][0]->user_birthday }}" required>
                                </div>
                                <div class="col">
                                    <label for="user_place_of_birth">Place of Birth</label>
                                    <input type="text" class="form-control" id="user_place_of_birth" name="user_place_of_birth" value="{{ $data['user_data'][0]->user_place_of_birth }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="user_height">Height</label>
                                    <input type="number" class="form-control" step="any" name="user_height" id="user_height" value="{{ $data['user_data'][0]->user_height }}" required>
                                </div>
                                <div class="col">
                                    <label for="user_weight">Weight</label>
                                    <input type="number" class="form-control" step="any" name="user_weight" id="user_weight" value="{{ $data['user_data'][0]->user_weight }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_current_address">Current Address</label>
                                <input type="text" class="form-control" name="user_current_address" id="user_current_address" value="{{ $data['user_data'][0]->user_current_address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_address">Address</label>
                                <input type="text" class="form-control" name="user_address" id="user_address" value="{{ $data['user_data'][0]->user_address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_degree">Degree</label>
                                <input type="text" class="form-control" name="user_degree" id="user_degree" value="{{ $data['user_data'][0]->user_degree }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_elementary">Elementary</label>
                                <input type="text" class="form-control" name="user_elementary" id="user_elementary" value="{{ $data['user_data'][0]->user_elementary }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_highschool">High School</label>
                                <input type="text" class="form-control" name="user_highschool" id="user_highschool" value="{{ $data['user_data'][0]->user_highschool }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_college">College</label>
                                <input type="text" class="form-control" name="user_college" id="user_college" value="{{ $data['user_data'][0]->user_college }}" required>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Misc</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_sss">SSS No.</label>
                        <input type="text" class="form-control" name="user_sss" id="user_sss" value="{{ $data['user_data'][0]->user_sss }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_tin">TIN No.</label>
                        <input type="text" class="form-control" name="user_tin" id="user_tin" value="{{ $data['user_data'][0]->user_tin }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_nbi">NBI</label>
                        <input type="text" class="form-control" name="user_nbi" id="user_nbi" value="{{ $data['user_data'][0]->user_nbi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_passport">Passport</label>
                        <input type="text" class="form-control" name="user_passport" id="user_passport" value="{{ $data['user_data'][0]->user_passport }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_position">Position</label>
                        <select name="user_position" class="custom-select" id="user_position" required>
                            <option value="hr" @if($data['user_data'][0]->user_position == "hr") {{ "selected" }} @endif>HR(Human Resource)</option>
                            <option value="civilengineer" @if($data['user_data'][0]->user_position == "civilengineer") {{ "selected" }} @endif>Civil Engineer</option>
                            <option value="projectmanager" @if($data['user_data'][0]->user_position == "projectmanager") {{ "selected" }} @endif>Project Manager</option>
                            <option value="expediter" @if($data['user_data'][0]->user_position == "expediter") {{ "selected" }} @endif>Expediter</option>
                            <option value="projectmanager" @if($data['user_data'][0]->user_position == "projectmanager") {{ "selected" }} @endif>Project Manager</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_rate">Rate</label>
                        <select name="user_rate" class="custom-select" id="user_rate" value="{{ $data['user_data'][0]->user_rate }}" required>
                            <option value="hourly"  @if($data['user_data'][0]->user_rate == "hourly") {{ "selected" }} @endif>Hourly</option>
                            <option value="monthly"  @if($data['user_data'][0]->user_rate == "monthly") {{ "selected" }} @endif>Monthly</option>
                            <option value="projectbased"  @if($data['user_data'][0]->user_rate == "projectbased") {{ "selected" }} @endif>Project Based</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_income">Income</label>
                        <input type="number" step="any" class="form-control" name="user_income" id="user_income" value="{{ $data['user_data'][0]->user_income }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_status">Status</label>
                        <select name="user_status" class="custom-select" id="user_status" required>
                            <option value="casual"  @if($data['user_data'][0]->user_status == "casual") {{ "selected" }} @endif>Casual</option>
                            <option value="freelance"  @if($data['user_data'][0]->user_status == "freelance") {{ "selected" }} @endif>Freelance</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").slideUp(500);
        }, 3000);
    });
</script>

@endsection