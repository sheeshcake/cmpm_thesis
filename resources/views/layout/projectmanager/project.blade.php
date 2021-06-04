
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
                <h3><b id="project_name">{{ $data["project"][0]["project_name"] }}</b></h3>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success')}}
                </div>
                @endif
                <div class="overflow-auto">
                    <div class="my-3 h-100" id="chart_div"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="project_name_input">Project Name</label>
                            <input type="text" class="form-control" id="project_name_input" placeholder="Project Name" value="{{ $data['project'][0]['project_name'] }}" @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="project_address">Project Address</label>
                            <input type="text" class="form-control" id="project_address_input" placeholder="Project Address" value="{{ $data['project'][0]['project_address'] }}" @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="client_id">Select Client</label>
                            <select name="client_id" id="client_id" class="custom-select" disabled>
                                @foreach($data['clients'] as $client)
                                    <option value="{{ $client['id'] }}" @if($data['project'][0]['client_id'] == $client['id']) selected @endif>{{ $client["client_f_name"] . " " . $client["client_l_name"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="project_estimate">Project Estimate</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">₱</span>
                            </div>
                            <input type="number" value="{{ $data['project'][0]['project_estimate'] }}" class="form-control" id="project_esimate_input" placeholder="Project Esimate">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-center">
                    <h4>Contract</h4>
                </div>
                <iframe width="100%" height="500px" src="{{ $data['project'][0]['project_contract'] }}" frameborder="0"></iframe>
                <hr>
                <form action="#" id="plan-details">
                    <div class="row" id="plan_input">
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_name_input">Plan Name</label>
                                <input type="text" id="plan_name_input" class="form-control" placeholder="Plan Name" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_date_start">Plan Date Start</label>
                                <input type="date" id="plan_date_start" class="form-control" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_date_end">Plan Date End</label>
                                <input type="date" id="plan_date_end" class="form-control" required @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_parent">Plan Dependencies</label>
                                <select id="plan_parent" class="custom-select" @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                                    <option value="" disabled selected>Select Dependencies</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="plan_priority">Plan Priority</label>
                                <select id="plan_priority" class="custom-select" @if($data['project'][0]['project_status'] == "approved") readonly @endif>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-2" id="plan_btn" @if($data['project'][0]['project_status'] == "approved") disabled @endif>Add Plan</button>
                </form>
                <table class="table table-striped" id="plan_table">
                    <thead>
                        <th>Plan ID</th>
                        <th>Plan Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Dependency</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table><hr>
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
                <form action="{{ route('approveproject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['project'][0]['id'] }}">
                    <input type="submit" class="btn btn-primary" value="Approve This Project">
                </form>
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
                        <div id="plan_tasks"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    var table = $('#plan_table').DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger' @if($data['project'][0]['project_status'] == 'approved') disabled @endif>Delete</button>"
        } ]
    });
    var supply_table = $("#supply_table").DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger' @if($data['project'][0]['project_status'] == 'approved') disabled @endif>Delete</button>"
        } ]
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

    $('#plan_table tbody').on( 'click', 'button', function () {
        var rowId = table.row( $(this).parents('tr') ).index();
        db_data.plans.splice(rowId, 1);
        $("#plan_parent option[value='plan-" + rowId + "']").remove();
        table.row(rowId).remove().draw();
        data.removeRow(rowId);
        console.log(rowId);
        if(db_data.plans.length > 0){
            chart.draw(data);
        }else{
            $("#chart_div").hide();
        }
        
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
            if(element["plan_dependency"] == "plan-null" || element["plan_dependency"] == "null"){
                element["plan_dependency"] = null;
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
                element["plan_dependency"]
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
                    "plan-" + db_data["plans"].length ,
                    $("#plan_name_input").val(),
                    $("#plan_priority").val(),
                    new Date($("#plan_date_start").val()),
                    new Date($("#plan_date_end").val()),
                    null,
                    0,
                    parent
                ]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('addplan')}}",
                    method: "POST",
                    data:{
                        "project_id" : "{{ $data['project'][0]['id'] }}",
                        "plan_name" : $("#plan_name_input").val(),
                        "plan_date_start" : $("#plan_date_start").val(),
                        "plan_date_end" : $("#plan_date_end").val(),
                        "plan_priority" : $("#plan_priority").val(),
                        "plan_dependency" : "plan-" + parent,
                    },
                    success: function(e){
                        var d = JSON.parse(e);
                        table.row.add([
                            d["id"],
                            $("#plan_name_input").val(),
                            $("#plan_date_start").val(),
                            $("#plan_date_end").val(),
                            parent_name,
                            $("#plan_priority").val(),
                            "<button class='btn btn-danger remove_plan' onclick='removePlan(" + $counter + ")'>Delete</button>"
                        ]).draw().node();
                    }
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
                console.log(data.getNumberOfRows() * trackHeight);
                chart.draw(data);
                $counter++;
            }
        });
        google.visualization.events.addListener(chart, 'select', function(){
            var selections = chart.getSelection();
            var selection = selections[0];
            $("#plan_name").text(data.getValue(selection.row, 1));
            var plan_details = data.getValue(selection.row, 0).split("-");
            $("#plan_tasks").html("");
            $("#plan_tasks").append(
                "<img src='" + db_data["plans"][plan_details[1]]["plan_image"] + "' width='100%' height='300px'><hr><div class='d-flex justify-content-center'><h4>Tasks</h4></div>"
            );
            db_data["plans"][plan_details[1]]["tasks"].forEach(function(element){
                $("#plan_tasks").append(
                    '<div class="card mt-3">' +
                        '<div class="card-body">' +
                            '<p> ' + element.task_name + ' </p>' +
                            '<p> ' + element.task_date_start  + ' to ' + element.task_date_end + '</p>' +
                        '</div>' +
                    '</div>' 
                );
            });
            $("#task_plan_id").val(plan_details[1]);
            $('#plan_modal').modal('show');
        });
    }
    $(document).ready(function(){
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(init_data);
    });
</script>
@endsection