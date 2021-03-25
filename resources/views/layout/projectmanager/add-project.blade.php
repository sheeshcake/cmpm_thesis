
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
                    </div>
                </div>
                <hr>
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
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
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

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var $counter = 0;
    var project_data = {
        project_name: "New Project",
        project_address: "",
        plans:[],
        tasks:[]
    };
    var data, chart;
    var table = $('#plan_table').DataTable();
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart); 

    $("#project_name_input").on("input", function(){
        $("#project_name").text($(this).val());
        project_data.project_name = $(this).val();
    });
    

    $("#project_address_input").on("input", function(){
        project_data.project_address = $(this).val();
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
            }
        })
    });



    function daysToMilliseconds(days) {
        return days * 24 * 60 * 60 * 1000;
    }

    function removePlan(index){
        if(data.getNumberOfRows() == 1){
            data.removeRow(index);
            chart.draw();
        }else{
            data.removeRow(index);
            chart.draw(data, {height: 300, title: project_data.project_name});
        }

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
        $("#plan_btn").click(function(){
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
                    $("#plan_priority").val(),
                    "<button class='btn btn-danger remove_plan' onclick='removePlan(" + $counter + ")'>Delete</button>"
                ]).draw().node();
                project_data.plans[$counter] = [
                    $("#plan_name_input").val(),
                    $("#plan_date_start").val(),
                    $("#plan_date_end").val()
                ];
                chart.draw(data, {height: 300, title: project_data.project_name});
                $counter++;
            }
        });
        google.visualization.events.addListener(chart, 'select', function(){
            var selections = chart.getSelection();
            var selection = selections[0];
            $("#plan_name").text(data.getValue(selection.row, 1));
            $('#plan_modal').modal('show');
        });   
    }
</script>

@endsection