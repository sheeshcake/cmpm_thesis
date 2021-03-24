
@extends('home')

@section('sidebar')
    @include('layout.admin.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.admin.includes.topbar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>EMployees</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="employee-table">
                <thead>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($data["employees"] as $employee)
                        <tr>
                            <td>{{ $employee->user_id }}</td>
                            <td>{{ $employee->f_name . " " . $employee->l_name }}</td>
                            <td>
                            </td>
                            <td>
                                <a href="{{ route('employee', ['id' => $employee->user_id]) }}" class="btn btn-primary">Edit</a>
                                <button value="{{ $employee->user_id }}" class="btn btn-danger delete" data-toggle="modal" data-target="#employeemodal">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="employeemodal" tabindex="-1" role="dialog" aria-labelledby="employeemodal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeemodal">Delete Emplyee?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <b id="emp_name"></b>?
                    (this action cannot be undone)
                </div>
                <div class="modal-footer">
                    <form action="{{ route('removeemployee') }}" method="post">
                        @csrf
                        <input type="hidden" id="user_id" name="id" value="">
                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#employee-table').DataTable();
        $('#employee-table tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $("#emp_name").text(data[1]);
            $("#user_id").val(data[0]);
        });
    });
</script>

@endsection