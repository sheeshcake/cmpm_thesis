
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
                            <label for="project_estimate">Project Esimate</label>
                            <input type="number" class="form-control" id="project_esimate_input" placeholder="Project Esimate">
                        </div>
                        <div class="form-group">
                            <label for="client_id">Select Client</label>
                            <select name="client_id" id="client_id" class="custom-select">
                                @foreach($data['clients'] as $client)
                                    <option value="{{ $client['id'] }}">{{ $client["client_f_name"] . " " . $client["client_l_name"]}}</option>
                                @endforeach
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
                            <label for="plan_files">Plan Image</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="plan_files" required>
                                    <label class="custom-file-label" for="plan_files">Plan Image</label>
                                </div>
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
                    <button type="submit" class="btn btn-primary mb-2" id="plan_btn">Add Plan</button>
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
                <hr>
                <h3>Project Supplies</h3>
                <form action="#" id="supply_form">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_name">Supply Name</label>
                                <input type="text" class="form-control" id="supply_name" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_description">Supply Description</label>
                                <input type="text" class="form-control" id="supply_description" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_count">Supply Count</label>
                                <input type="number" class="form-control" id="supply_count" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="supply_count">Action</label>
                                <button class="btn btn-primary form-control" id="add_supply">Add Supply</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="supply_table">
                    <thead>
                        <th>Supply Name</th>
                        <th>Supply Description</th>
                        <th>Supply Count</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <hr>
                <button class="btn btn-success mt-2" id="submit_plan">Submit Project</button>
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
                            <input type="hidden" id="task_plan_id" value="">
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
                                        <input type="date" id="task_end" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="add-task">Add</button>
                        </form>
                        <hr>
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

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var $counter = 0;
    var project_data = {
        project_name: "New Project",
        project_address: "",
        plan_esimate: "",
        client_id: 1,
        plans:[],
        supplies:[],
    };
    var data, chart, task_counter = 0, supply_counter = 0;
    var table = $('#plan_table').DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger'>Delete</button>"
        } ]
    });
    var supply_table = $('#supply_table').DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger'>Delete</button>"
        } ]
    });
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart); 

    $("#client_id").on("change", function(){
        project_data.client_id = $(this).val();
    });

    $('#supply_table tbody').on( 'click', 'button', function () {
        console.log("before:" , project_data.supplies);
        var rowId = supply_table.row( $(this).parents('tr') ).index();
        project_data.supplies.splice(rowId, 1);
        supply_table.row(rowId).remove().draw();
        console.log("after:" , project_data.supplies);
    } );


    $("#supply_form").on("submit", function(e){
        e.preventDefault();
        project_data.supplies.push({
            "supply_name" : $("#supply_name").val(),
            "supply_description" : $("#supply_description").val(),
            "supply_count" : $("#supply_count").val()
        });
        console.log("added:" , project_data.supplies);
        supply_table.row.add([
            $("#supply_name").val(),
            $("#supply_description").val(),
            $("#supply_count").val()
        ]).draw().node();
        $("#supply_name").val("");
        $("#supply_description").val("");
        $("#supply_count").val("");
    });

    $("#project_name_input").on("input", function(){
        $("#project_name").text($(this).val());
        project_data.project_name = $(this).val();
    });
    

    $("#project_address_input").on("input", function(){
        project_data.project_address = $(this).val();
        console.log(project_data);
    });

    $("#project_esimate_input").on("input", function(){
        project_data.project_estimate = $(this).val();
        console.log(project_data);
    });

    $("#submit_plan").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('addproject') }}",
            method: "POST",
            data:{
                data: project_data
            },
            success: function(d){
                console.log(d);
                window.location.href = "project/" + d;
            }
        })
    });



    function daysToMilliseconds(days) {
        return days * 24 * 60 * 60 * 1000;
    }

    $('#plan_table tbody').on( 'click', 'button', function () {
        var rowId = table.row( $(this).parents('tr') ).index();
        project_data.plans.splice(rowId, 1);
        $("#plan_parent option[value='plan-" + rowId + "']").remove();
        table.row(rowId).remove().draw();
        data.removeRow(rowId);
        console.log(project_data.plans.length);
        if(project_data.plans.length > 0){
            chart.draw(data);
        }else{
            $("#chart_div").hide();
        }
        
    });
    const getBase64 = file => new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    async function GetBase(){
        var file = document.querySelector('#plan_files').files[0];
        let result = await getBase64(file).then(res => res.data);
        return result;
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
        $("#plan-details").on("submit", function(e){
            e.preventDefault();
            var file_base = GetBase();
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
                project_data.plans.push({
                    "plan_name" : $("#plan_name_input").val(),
                    "plan_start" : $("#plan_date_start").val(),
                    "plan_end" : $("#plan_date_end").val(),
                    "plan_priority" : $("#plan_priority").val(),
                    "plan_image": file_base,
                    "plan_dependency" : parent,
                    "tasks" : []
                });
                console.log(project_data);
                chart.draw(data, {height: 300, title: project_data.project_name});
                $counter++;
            }
            $("#chart_div").show();
        });
        google.visualization.events.addListener(chart, 'select', function(){
            var selections = chart.getSelection();
            var selection = selections[0];
            $("#plan_name").text(data.getValue(selection.row, 1));
            var plan_details = data.getValue(selection.row, 0).split("-");
            $("#task_plan_id").val(plan_details[1]);
            $("#plan_tasks").html("");
            project_data["plans"][plan_details[1]]["tasks"].forEach(function(element){
                $("#plan_tasks").append(
                    '<div class="card mt-3">' +
                        '<div class="card-body">' +
                            '<p> ' + element.task_name + ' </p>' +
                            '<p> ' + element.task_start  + ' to ' + element.task_end + '</p>' +
                        '</div>' +
                    '</div>' 
                );
            });
            $('#plan_modal').modal('show');
        });   
    }
</script>

@endsection