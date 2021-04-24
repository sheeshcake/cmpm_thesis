
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
                        <th>Plan Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Dependency</th>
                        <th>Priority</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="task_start">Task Start</label>
                                            <input type="date" id="task_start" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="task_end">Task End</label>
                                            <input type="date" id="task_end" class="form-control">
                                        </div>
                                    </div>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div id="plan_tasks"></div>
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

    $("#task-form").on("submit", function(e){
        e.preventDefault();
        var task_name = $("#task_name_input").val();
        var task_priority = $("#task_priority").val();
        var assigned_to = $("#task_user").val();
        var task_start = $("#task_start").val();
        var task_end = $("#task_end").val();
        db_data["plans"][$("#task_plan_id").val()].tasks.push({
            "task_name" : task_name,
            "task_priority" : task_priority,
            "task_start" : task_start,
            "task_end" : task_end, 
            "assigned_to" : assigned_to
        });
        task_counter++;
        $("#plan_tasks").append(
            '<div class="card p-3 mt-3">' +
                '<div class="row">' +
                    '<div class="col-lg-10 col-md-6">' +
                        '<p> ' + task_name + ' </p>' +
                        '<p> ' + task_start  + ' to ' + task_end + '</p>' +
                    '</div>' +
                    '<div class="col-lg-2 col-md-6">' +
                        '<button class="btn btn-danger">Delete Task</button>' +
                    '</div>' +
                '</div>' +
            '</div>' 
        );
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
        db_data["plans"].forEach(function(element, index, array){
                data.addRow([
                    "plan-" + index ,
                    element["plan_name"],
                    element["plan_priority"],
                    new Date(element["plan_date_start"]),
                    new Date(element["plan_date_end"]),
                    1,
                    0,
                    element["plan_dependency"]
                ]);
                table.row.add([
                    element["plan_name"],
                    element["plan_date_start"],
                    element["plan_date_end"],
                    element["plan_dependency"],
                    element["plan_priority"]
                ]).draw();
                $("#plan_parent").append(new Option(element["plan_name"], index));
                itemsProcessed++;
                if(itemsProcessed === array.length) {
                    $counter = array.length;
                    chart.draw(data, {height: 300, title: db_data.project_name});
                }
            });
        
        $("#plan-details").on("submit", function(e){
            e.preventDefault();
            if($("plan_input input[required]").filter(function () {
                    return $.trim($(this).val()).length == 0
                }).length == 0){
                var parent = null;
                var parent_name = "None";
                if($("#plan_parent").val() != null){
                    parent = $("#plan_parent").val();
                    parent_name = $("#plan_parent option:selected").text();
                }
                $("#plan_parent").append(new Option( $("#plan_name_input").val(), "plan-" + $counter));
                data.addRow([
                    "plan-" + $counter ,
                    $("#plan_name_input").val(),
                    $("#plan_priority").val(),
                    new Date($("#plan_date_start").val()),
                    new Date($("#plan_date_end").val()),
                    null,
                    0,
                    parent
                ]);
                table.row.add([
                    $("#plan_name_input").val(),
                    $("#plan_date_start").val(),
                    $("#plan_date_end").val(),
                    parent_name,
                    $("#plan_priority").val()
                ]).draw().node();
                db_data.plans.push({
                    "plan_name" : $("#plan_name_input").val(),
                    "plan_date_start" : $("#plan_date_start").val(),
                    "plan_date_end" : $("#plan_date_end").val(),
                    "plan_priority" : $("#plan_priority").val(),
                    "plan_dependency" : parent,
                    "tasks" : []
                });
                chart.draw(data, {height: 300, title: db_data.project_name});
                $counter++;
            }
        });
        google.visualization.events.addListener(chart, 'select', function(){
            var selections = chart.getSelection();
            var selection = selections[0];
            $("#plan_name").text(data.getValue(selection.row, 1));
            var plan_details = data.getValue(selection.row, 0).split("-");
            $("#plan_tasks").html("");
            db_data["plans"][plan_details[1]]["tasks"].forEach(function(element){
                $("#plan_tasks").append(
                    '<div class="card p-3 mt-3">' +
                        '<div class="row">' +
                            '<div class="col-lg-10 col-md-6">' +
                                '<p> ' + element.task_name + ' </p>' +
                                '<p> ' + element.task_date_start  + ' to ' + element.task_date_end + '</p>' +
                            '</div>' +
                            '<div class="col-lg-2 col-md-6">' +
                                '<button class="btn btn-danger">Delete Task</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>' 
                );
            });
            $("#task_plan_id").val(plan_details[1]);
            $("#submit_tasks").val(plan_details[1]);
            $('#plan_modal').modal('show');
        });
    }
    $("#submit_tasks").click(function(){
        console.log($(this).val());
        console.log($(this).attr("plan_id"));
        console.log(db_data["plans"][$("#task_plan_id").val()].tasks);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('updatetasks') }}",
            method: "POST",
            data:{
                "plan_id" : $(this).val()   ,
                "tasks": db_data["plans"][$(this).val()].tasks
            },
            success: function(e){
                console.log(e);
            }
        })
    });
    // function send_tasks(btn){
    //     console.log(btn.val());
    // }
    $(document).ready(function(){
        // init_data();
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(init_data);
    });
</script>
@endsection