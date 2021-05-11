
@extends('home')

@section('sidebar')
    @include('layout.civilengineer.includes.sidebar')
@endsection

@section('topbar')
    @include('layout.civilengineer.includes.topbar')
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="scrollable">
        <div class="card">
            <div class="card-header">
                <h3><b id="project_name">{{ $data["project"][0]["project_name"] }}</b></h3>
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
                            <input type="text" class="form-control" id="project_name_input" placeholder="Project Name" value="{{ $data['project'][0]['project_name'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="project_address">Project Address</label>
                            <input type="text" class="form-control" id="project_address_input" placeholder="Project Address" value="{{ $data['project'][0]['project_address'] }}" readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="client_id">Select Client</label>
                            <select name="client_id" id="client_id">
                                
                            </select>
                        </div> -->
                    </div>
                </div>
                <hr>
                <table class="table table-striped" id="plan_table">
                    <thead>
                        <th>ID</th>
                        <th>Plan Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Dependency</th>
                        <th>Priority</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <hr>
                <h3>Project Supplies</h3>
                <form action="#" id="supply_form">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_name">Supply Name</label>
                                <input type="text" class="form-control" id="supply_name" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_description">Supply Description</label>
                                <input type="text" class="form-control" id="supply_description" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_count">Supply Count</label>
                                <input type="number" class="form-control" id="supply_count" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_count">Action</label>
                                <button class="btn btn-primary form-control" id="add_supply" required @if($data['project'][0]['project_status'] == "approved") disabled @endif>Add Supply</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="supply_table">
                    <thead>
                        <th>Supply ID</th>
                        <th>Supply Name</th>
                        <th>Supply Description</th>
                        <th>Supply Count</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <hr>
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
                        <form action="#" id="task-form">
                            <input type="hidden" value="" id="task_plan_id">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="task_name_input">Task Name</label>
                                        <input type="text" id="task_name_input" class="form-control" placeholder="Task Name" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="task_priority">Task Priority</label>
                                        <select id="task_priority" class="custom-select" required>
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="task_user">Assign To</label>
                                        <select id="task_user" class="custom-select" required>
                                            @foreach($data["users"] as $user)
                                                <option value="{{ $user['id'] }}">{{ $user["f_name"] . " " . $user["l_name"] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="task_start">Task Start</label>
                                            <input type="date" id="task_start" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="task_end">Task End</label>
                                            <input type="date" id="task_end" class="form-control" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table class="table table-striped" id="task_table">
                            <thead>
                                <th>ID</th>
                                <th>Task Name</th>
                                <th>Task Priority</th>
                                <th>Assigned To</th>
                                <th>Task Start</th>
                                <th>Task End</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" value="" id="submit_tasks">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var data, chart, db_data, task_counter = 0, $counter = 0;
    var table = $('#plan_table').DataTable();
    var task_table = $("#task_table").DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger @if($data['project'][0]['project_status'] == 'approved') disabled @endif'>Delete</button>"
        } ]
    });
    var supply_table = $("#supply_table").DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger' @if($data['project'][0]['project_status'] == 'approved') disabled @endif>Delete</button>"
        } ]
    });
    $('#task_table tbody').on( 'click', 'button', function () {
        var rowId = table.row( $(this).parents('tr') ).index();
        var id = task_table.row(rowId).data()[0];
        task_table.row(rowId).remove().draw();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('removetask')}}",
            method: "POST",
            data:{
                "id": id
            },
            success: function(e){
                d = JSON.parse(e);
                alert(d["alert"]);
            }
        });
        data.removeRow(rowId);
        
    });
    $("#task-form").on("submit", function(e){
        e.preventDefault();
        var task_name = $("#task_name_input").val();
        var task_priority = $("#task_priority").val();
        var assigned_to = $("#task_user").val();
        var task_start = $("#task_start").val();
        var task_end = $("#task_end").val();
        var plan_id = $("#task_plan_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('addtask') }}",
            method: "POST",
            data: {
                "plan_id" : plan_id,
                "task_name" : task_name,
                "task_priority" : task_priority,
                "user_id" : assigned_to,
                "task_date_start" : task_start,
                "task_date_end" : task_end,
                "task_status" : "pending"
            },
            success: function(d){
                d = JSON.parse(d);
                task_table.row.add([
                    d["id"],
                    task_name,
                    task_priority,
                    $("#task_user option:selected").text(),
                    task_start,
                    task_end
                ]).draw();
            }
        })
    });
    $("#supply_form").on("submit", function(e){
        e.preventDefault();
        var d;
        db_data.supplies.push({
            "supply_name" : $("#supply_name").val(),
            "supply_description" : $("#supply_description").val(),
            "supply_count" : $("#supply_count").val()
        });
        console.log("added:" , db_data.supplies);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('addsupply')}}",
            method: "POST",
            data:{
                "project_id" : "{{ $data['project'][0]['id'] }}",
                "supply_name" : $("#supply_name").val(),
                "supply_description" : $("#supply_description").val(),
                "supply_count" : $("#supply_count").val()
            },
            success: function(e){
                d = JSON.parse(e);
                supply_table.row.add([
                    d["id"],
                    $("#supply_name").val(),
                    $("#supply_description").val(),
                    $("#supply_count").val()
                ]).draw().node();
                $("#supply_name").val("");
                $("#supply_description").val("");
                $("#supply_count").val("");
            }
        });
    });
    $('#supply_table tbody').on( 'click', 'button', function () {
        var rowId = table.row( $(this).parents('tr') ).index();
        db_data.plans.splice(rowId, 1);
        var id = supply_table.row(rowId).data()[0];
        supply_table.row(rowId).remove().draw();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('removesupply')}}",
            method: "POST",
            data:{
                "id": id
            },
            success: function(e){
                d = JSON.parse(e);
                alert(d["alert"]);
            }
        });
        data.removeRow(rowId);
        
    });


    function init_data(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getdata')}}",
            method: "POST",
            data:{
                "project_id" : "{{ $data['project'][0]['id'] }}"
            },
            success: function(e){
                db_data = JSON.parse(e);
                drawChart();
            }
        });
    }
    function drawChart() {
        data = new google.visualization.DataTable();
        data.addColumn('string', 'Task ID');
        data.addColumn('string', 'Task Name');
        data.addColumn('string', 'Priority');
        data.addColumn('date', 'Start Date');
        data.addColumn('date', 'End Date');
        data.addColumn('number', 'Duration');
        data.addColumn('number', 'Percent Complete');
        data.addColumn('string', 'Dependencies');
        chart = new google.visualization.Gantt(document.getElementById('chart_div'));
        var itemsProcessed = 0;
        db_data["plans"].forEach(async (element, index, array) => {
            $dependency = element["plan_dependency"];
            if($dependency == "plan-null" || $dependency == "null"){
                $dependency = null;
            }
            var plan_id = "plan-" + index;
            data.addRow([
                plan_id ,
                element["plan_name"],
                element["plan_priority"],
                new Date(element["plan_date_start"]),
                new Date(element["plan_date_end"]),
                1,
                0,
                $dependency
            ]);
            table.row.add([
                element["id"],
                element["plan_name"],
                element["plan_date_start"],
                element["plan_date_end"],
                element["plan_dependency"],
                element["plan_priority"]
            ]).draw();
            $("#plan_parent").append(new Option(element["plan_name"], index));
        });
        db_data["supplies"].forEach(async (element) => {
            supply_table.row.add([
                element["id"],
                element["supply_name"],
                element["supply_description"],
                element["purchased"] + "/" + element["supply_count"],
            ]).draw();
        });
        var trackHeight = 40;
        var options = {
            height: data.getNumberOfRows() * trackHeight,
            width: "100%",
            hAxis: {
                textStyle: {
                    fontName: ["RobotoCondensedRegular"]
                }
            },
            gantt: {
                labelStyle: {
                fontName: ["RobotoCondensedRegular"],
                fontSize: 12,
                color: '#757575',
                },
                trackHeight: trackHeight
            }
        };
        chart.draw(data, options);
        google.visualization.events.addListener(chart, 'select', function(){
            var selections = chart.getSelection();
            var selection = selections[0];
            task_table.clear();
            $("#plan_name").text(data.getValue(selection.row, 1));
            $("#task_plan_id").val(table.row(selection.row).data()[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('gettasks') }}",
                method: "post",
                data:{
                    plan_id : table.row(selection.row).data()[0]
                },
                success: function(d){
                    d = JSON.parse(d);
                    task_table.clear().draw();
                    d.forEach(async (item) => {
                        task_table.row.add([
                            item.task_id,
                            item.task_name,
                            item.task_priority,
                            item.f_name + " " + item.l_name,
                            item.task_date_start,
                            item.task_date_end
                        ]).draw();
                    });

                }
            })
            $('#plan_modal').modal('show');
        });
    }
    $(document).ready(function(){
        // init_data();
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(init_data);
    });
</script>
@endsection