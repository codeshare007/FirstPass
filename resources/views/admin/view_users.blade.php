@extends('layouts.app')
@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .refresh-btn{
            position: absolute;
            top: 13px;
            right: 22px;
        }
        .buttons-csv.buttons-html5{margin-bottom: 10px}
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Users List</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        @if(auth()->user()->user_type == 'super')
            <div class="form-group">
                <div class="col-12" >
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#ImportModal"><button  style="float: right;" class="btn btn-success">Import Users</button></a>
                </div>
            </div>
        @endif
        <br>
        <div id="accordion">

            <div class="card">
                <div class="card-header" id="headingTwo" style="background:#6b5fb5;">
                    <h5 class="mb-0" style="color: #ffffff;">
                        ADD USER
                        <a  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="float: right;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

                    <div class="col-6">

                        <form class="m-t-40" id="user_form" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="hidden" name="id" class="form-control" >
                            <div class="form-group">
                                <h5>First Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Last Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="lname" class="form-control" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Email Address<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" required > </div>
                            </div>
                            <div class="form-group">
                                <h5>Password <span id="pass-danger" class="text-danger">*</span></h5>
                                <div class="controls input-group">
                                    <input type="password" name="password" class="form-control" required >
                                    <div class="input-group-append">
                                        <button class="btn btn-success show_password" type="button"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>User Type<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="type" id="type" required class="form-control">
                                        <option value=""></option>
                                        <option value="inst">Instructor</option>
                                        <option value="learner">Learner</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Gender<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="gender" id="gender" required class="form-control">
                                        <option value=""></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <center class="m-t-30">
                                <img src="" class="image_preview img-circle" width="150">
                            </center>

                            <div class="form-group">
                                <label class="col-md-12">Upload Profile Picture to Update</label>
                                <div class="col-md-12">
                                    <input type="file" name="profile" id="profile" onchange="readURL(this, '.image_preview')">
                                    <p class="m-t-5"><span class="text-danger">*</span>File size must be less than 1MB and type of jpeg, png, jpg, svg</p>
                                </div>
                            </div>

                            <div class="text-xs-right mb-3 m-t-10">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header" id="headingOne" style="background: #4bd396;">
                    <h5 class="mb-0" style="color: #ffffff;">
                        ALL USERS
                        <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <button class="refresh-btn btn btn-xs m-b-5 btn-primary pull-right m-b-5" data-toggle="tooltip" data-title="Refresh data" onclick="$('#users_table').DataTable().ajax.reload();"><i class="fas fa-sync-alt"></i></button>
                                    <div class="table-responsive">
                                        <table  id="users_table" class="table table-striped table-bordered display">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Gender</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


        @endsection
        @section('scripts')
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>

            <!-- This Page JS -->
            <script>
                $('#user_form').submit(function(){
                    //alert("yes");
                    $("#loading").show();
                    var dd = new FormData(this);
                    // dd.append('email_temp',CKEDITOR.instances['ck_edit'].getData());
                    //dd.append('id',$("input[name='template_id']").val());
                    $.ajax({
                        url: "{{Route('user.store')}}",
                        data: dd,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (res) {
                            $("#loading").hide();
                            if (res.success == true) {

                                Swal.fire({
                                    type: 'success',
                                    title: 'Stored',
                                    text: res.message,
                                    showConfirmButton: true,

                                });

                                $("#collapseTwo").hide();
                                $("#collapseOne").show();


                                $('#users_table').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: res.message,
                                })
                            }
                        }
                    });

                    return false;
                });

                $(document).ready(function() {

                    var table =  $('#users_table').DataTable({
                        dom: 'Blfrtip',
                        "processing": true,
                        "serverSide": true,
                        "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                text: '<i class="mdi mdi-file-delimited"></i> Export',
                                title: 'PR Users',
                                exportOptions: {
                                    columns: [0,1,2,3]
                                }
                            },
                        ],

                        "drawCallback": function () {
                            $('.myswitch').change(function () {

                                var id = $(this).val();
                                var obj = $(this).attr('data-obj');

                                var status = 0;

                                if(this.checked) {
                                    status = 1;
                                }
                                $.post('{{ route('update-status') }}',
                                    {id:id, obj:obj, status:status},
                                    function (data) {
                                        if(data.success == true){
                                            $('#packages_table').DataTable().ajax.reload();
                                        }else{
                                            swal('OOPs', data.message, 'error');
                                        }
                                    });
                            });
                        },
                        "ajax": "{{ route('get-users') }}",
                        "columns":[
                            { "data": "id", name:'id' },
                            { "data": "name", name:'name' },
                            { "data": "lname", name:'lname' },
                            { "data": "email", name:'email' },
                            { "data": "type", name:'type' },
                            { "data": "gender", name:'gender' },
                            { "data": "created_at", name:'created_at' },
                            { "data": "action", name:'Actions', searchable: false, orderable: false },
                        ]
                    });

                    table.buttons().container()
                        .appendTo('#users_table .col-md-6:eq(0)');

                    /*edit use*/

                });

                function get_user(id, type)
                {
                    $("#loading").show();
                    $("#leads_module").addClass('hidden');

                    $.get(base_url+"/user/"+id+"/edit",function(res){
                        $("#loading").hide();
                        if(res!='')
                        {
                            $("#headingTwo h5 a").attr('aria-expanded', true);

                            $("#collapseTwo").addClass('show').show();
                            $("#client-form-div").addClass("in");

                            $.each(res,function(k,v){
                                if(k=='type' || k=='gender')
                                {
                                    $('select[name="'+k+'"]').val(v)
                                }
                                else 
                                {
                                    $("input[name='" + k + "']").val(v);
                                }

                                $("input[type='password']").attr('required', false);
                                $("#pass-danger").css('display', 'none');
                            });
                            $("html, body").animate({ scrollTop: 0 }, 1000);
                        }
                    });
                }

                function add_credit(id) {

                    $("#loading").show();
                    $('#creditForm')[0].reset();

                    $.get("{{ url('get-credits') }}", {id:id}, function (res) {
                        $("#loading").hide();
                        if (res.success == true) {
                            $('#creditForm #user_id').val(res.user.id);
                            $('#creditForm #email_credits').val(res.user.email_credits);
                            $('#creditForm #lead_credits').val(res.user.lead_credits);
                            $('#creditForm #daily_lead_search').val(res.user.daily_lead_search);

                            $('#creditModal').modal('show');
                        }
                    })
                }

                function del_user(x)
                {

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $("#loading").show();
                            $.post('{{ route("delete-user")}}',{id:x, _token:"{{csrf_token()}}"},function(res){
                                $("#loading").hide();

                                if(res.success==true){

                                    swal("Deleted!",res.message, "success");
                                    $('#users_table').DataTable().ajax.reload();

                                }else if(res.success==false){
                                    swal("Error!",data.message, "error");
                                }

                            });

                        } else {
                            //swal("Cancelled", "Your action has been cancelled!", "cancel");
                        }
                    });
                }
                $(function () {

                    $('#customSwitches').change(function () {
                        alert ("yes");
                        //  var opt = $(this).val();
                        tinymce.get('email').insertContent(this.value);
                    });
                });

                function login_client(id) {
                    $.post('{{ route('user-login') }}',
                        { id:id, _token: '{{ csrf_token() }}' },
                        function (data) {
                            if(data.success == true){
                                window.location.href="{{ url('/home') }}";
                            }else{
                                swal('error', 'Oops invalid user identifier!', 'error')
                            }
                        });
                }
            </script>
@endsection
